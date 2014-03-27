<?php

use Goutte\Client;
use \Pennants\Club\ClubRepositoryInterface;
use Pennants\Rating\RatingRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class Ratings {
	protected $state = "QLD";
	protected $courseName = '';
	protected $position;
	protected $clubId;

	public function __construct($courseName, $state, $clubId, RatingRepositoryInterface $rating, ClubRepositoryInterface $club, $position = null)
	{
		$this->state = $state;
		$this->ratingsPath = "http://www.golf.org.au/default.aspx?s=aus-slope-ratings&State=";
		$this->courseName = $courseName;
		$this->club = $club;
		$this->position = $position;
		$this->rating = $rating;
		$this->clubId = $clubId;
	}

	protected function connection()
	{
		$client = new Client();
		$path = $this->ratingsPath.$this->state;
		$crawler = $client->request('GET', $path);
		return $crawler;
	}

	/**
	 * @return mixed|string
	 */

	public function checkCourse()
	{
		$crawler = $this->connection();
		$courses = $crawler->filter('tr.rowheader td:first-child')->each(function($node) {
			return $node->text();
		});
		if(in_array($this->courseName, $courses)) {
			$this->position = $this->setPosition($courses);
			$course = $this->courseName;
		} else {
			$courses_found = $this->modifyCourse($courses, $this->clubId);
			if(count($courses_found) > 1) {
				$course = $this->checkCourses($courses_found, $this->clubId);
			} else {
				return $courses_found;
			}
		}
		return $course;
	}

	/**
	 * @param $courses
	 * @return mixed
	 */

	protected function modifyCourse($courses)
	{
		foreach($courses as $key => $course) {
			$name = explode(' ', $course);
			preg_match("/^{$name[0]}/", $this->courseName, $matches);
			if(count($matches) > 0) {
				// set the position so we can pull the values later on
				$this->position = $key;
				$courses_found[$key] = $course;
			}
		}

		$course = $this->checkCourses($courses_found);
		return $course;
	}

	/**
	 * Get the position of the name in the list of courses inside the state
	 *
	 * @param $courses
	 * @return mixed
	 */

	protected function setPosition($courses)
	{
		return array_search($this->courseName, $courses);
	}

	/**
	 * @param $courses_found
	 * @return mixed
	 */

	protected function checkCourses($courses_found) {
		if(count($courses_found) > 1) {
			foreach($courses_found as $number => $course) {
				// Seperate all words so we can match the golf.org.au website results
				$name = explode(" ", $course);
				for($i = 1; $i < count($name); $i++) {
					// match the courses name
					preg_match("/{$name[$i]}/", $this->courseName, $matches);
					if(count($matches) == 0) {
						unset($courses_found[$number]);
						if(count($courses_found) == 1) {
							break;
						}
					}
				}
			}
		}

		$this->club->updateName($courses_found[0], $this->clubId);
		// If we hit this point, lets update the courses name so it matches for future checks.
		return $courses_found[0];
	}

	/**
	 * Filter
	 */

	public function getRatings()
	{
		$crawler = $this->connection();
		#TODO - try and filter this a bit better instead of getting full list
		$filter = $crawler->filter('tr.rowheader')->eq($this->position)->nextAll()->each(function($node) {
			return $node->text();
		});
		// would be good to get rid of this, since it times out sometimes.
		$filter = array_slice($filter, 0, 50);
		$ratings = array();
		foreach($filter as $result) {
			// Set holes value for when we dont have a value
			$holes = null;
			// Strip out spaces, line breaks etc...
			$filter_result = preg_replace('/^\s+|\n|\r|\s+$/m', ' ', $result);
			// Time for some actioning
			$filter_result = explode(" ", $filter_result);
			// get rid of all the empty results and reindex array
			$rating = array_values(array_filter($filter_result));
			if(count($rating) <= 1) {
				break;
			} else {
				// filter out items that are not needed
				switch(count($rating)) {
					case '10':
						$holes = $rating[6];
						unset($rating[0]);
						unset($rating[1]);
						unset($rating[2]);
						unset($rating[6]);
						$rating = array_values($rating);
						break;
					case '7':
						$holes = $rating[3];
						unset($rating[3]);
						$rating = array_values($rating);
						break;
				}

				// Now we need to prepare json returned values
				$course_rating = array(
					'club_id' => $this->clubId,
					'tee_name' => $rating[1],
					'tee_sex' => $rating[2],
					'par' => $rating[3],
					'scratch' => $rating[4],
					'holes' => $holes,
					'slope' => $rating[5]

				);
				// other values that we need to filter on
				$values = array(
					'club_id' => $this->clubId,
					'tee_name' => $rating[1],
					'tee_sex' => $rating[2],
					'holes' => $holes,
					'ratings' => json_encode($course_rating)
				);

				$ratings[] = $values;
			}
		}
		$this->actionRatings($ratings);
	}

	/**
	 * Prepare values for inserting
	 *
	 * @param $ratings
	 * @return array
	 */

	protected function actionRatings($ratings) {
		$action = array();
		if(count($ratings) > 0) {
			foreach($ratings as $rating) {
				$check_rating = $this->rating->getRating($rating['tee_name'], $rating['tee_sex'], $rating['club_id'], $rating['holes']);

				$values = array(
					'club_id' => $rating['club_id'],
					'tee_name' => $rating['tee_name'],
					'tee_sex' => $rating['tee_sex'],
					'ratings' => $rating['ratings'],
					'holes' => $rating['holes']
				);

				if(count($check_rating) == 0) {
					$inserted = $this->rating->create($values);
					if($inserted) {
						$action[] = $inserted;
					}
				} else {
					$old_payload = json_decode($check_rating[0]->ratings);
					$new_payload = json_decode($rating['ratings']);
					$difference = array_diff_assoc((array)$old_payload, (array)$new_payload);
					if(count($difference) > 0) {
						$updated = $this->rating->update($values, $check_rating->id);
						if($updated) {
							$action[] = $updated;
						}
					}
				}
			}
		}
		return $action;
	}
}