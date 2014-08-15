<?php
namespace Ratings;

use Goutte\Client;
use Pennants\Club\ClubRepositoryInterface;
use Pennants\Rating\RatingRepositoryInterface;
use Symfony\Component\DomCrawler\Crawler;

class ClubRatings {

	/**
	 * @param RatingRepositoryInterface $rating
	 * @param ClubRepositoryInterface $club
	 */
	public function __construct(RatingRepositoryInterface $rating, ClubRepositoryInterface $club)
	{
		$this->requestPath = "http://www.golf.org.au/default.aspx?s=aus-slope-ratings&State=";
		$this->rating = $rating;
		$this->club = $club;
	}

	/**
	 * @param $course
	 * @param $state
	 * @param $clubId
	 * @param string $club
	 * @return mixed
	 */
	public function initialize($course, $state, $clubId, $club = '')
	{
		$client = new Client();
		$path = $this->setPath($state);
		$crawler = $client->request('GET', $path);

		if(isset($course)) {
			$course = $this->setCourseName($course, $state);

		}

		$courses = $this->getCourses($crawler);

		$position = $this->setPosition($course, $courses);

		return $position;
	}

	/**
	 * @param $state
	 * @return string
	 */
	public function setPath($state)
	{
		$path = $this->requestPath;
		$path .= $state;
		return $path;
	}

	/**
	 * @param $course
	 * @param $state
	 * @return string
	 */
	public function setCourseName($course, $state)
	{
		$courseName = $course;
		$courseName .= " (".$state.")";
		return $courseName;
	}

	/**
	 * @param $crawler
	 * @return mixed
	 */

	public function getCourses($crawler)
	{
		// Get a list of all of the courses.
		$courses = $crawler->filter('tr.rowheader td:first-child')->each(function($node) {
			return $node->text();
		});

		return $courses;
	}

	/**
	 * @param $course
	 * @param $courses
	 * @return mixed
	 */
	public function setPosition($course, $courses)
	{
		if(in_array($course, $courses)) {
			// If course is found in the list, lets tell the system the position it is found in the list
			$position = array_search($course, $courses);;

			return $position;
		}
		return false;
	}

	/**
	 * @param $courses
	 * @param $clubId
	 * @return bool|mixed
	 */
	public function validateCourse($courses, $clubId) {
		// Match the course named to one in the list.
		$courses_found = $this->modifyCourse($courses, $clubId);
		if($courses_found) {
			$course = $this->checkCourses($courses_found, $clubId, false);
		} else {
			// Return a message the no course could be located
			return false;
		}
		return $course;
	}


	/**
	 * @param $courses
	 * @param $courseName
	 * @return mixed
	 */
	protected function modifyCourse($courses, $courseName)
	{
		$courses_found = array();
		$position = null;

		if(count($courses) > 0) {
			foreach($courses as $key => $course) {
				$name = explode(' ', $course);
				preg_match("/^{$name[0]}/", $courseName, $matches);
				if(count($matches) > 0) {
					// set the position so we can pull the values later on
					$position = $key;
					$courses_found[$key] = $course;
				}
			}
		}

		$course = $this->checkCourses($courses_found, $courseName, $position = false);

		// The course returned, has it already been added and exists in the database
		if(!empty($course)) {
			$course_exists = \Club::getName($course)->getActive('N')->first();
			if($course_exists) {
				// Lets active the site
				$this->club->updateStatus('active', $course_exists->id);
			}
		}

		return $course;
	}

	/**
	 * @param $courses_found
	 * @param $courseName
	 * @param $position
	 * @param $clubId
	 * @return bool
	 */
	public function checkCourses($courses_found, $courseName, $position, $clubId = null) {
		if(count($courses_found) > 1) {
			foreach($courses_found as $number => $course) {
				// Seperate all words so we can match the golf.org.au website results
				// Will be better to preg_replace because there will be more coming in the future
//				preg_replace();
				$name = explode(" ", str_replace('+', '', $course));
				$name = array_values(array_filter($name));
				$state = array_pop($name);
				for($i = 0; $i < count($name); $i++) {
					// match the courses name
					preg_match("/{$name[$i]}/", $courseName, $matches);
					#TODO this needs to be redone
					if(count($matches) == 0) {
						unset($courses_found[$number]);
						if(count($courses_found) == 1) {
							break;
						}
					}
				}
			}
		}

		if(count($courses_found) > 0 && !is_null($clubId)) {
			// If we hit this point, lets update the courses name so it matches for future checks.
			\Club::updateName($courses_found[$position], $clubId);
			return $courses_found[$position];
		}
		return false;
	}

	/**
	 * Filter
	 */

	public function getRatings($position, $crawler, $clubId)
	{
		#TODO - try and filter this a bit better instead of getting full list
		$filter = $crawler->filter('tr.rowheader')->eq($position)->nextAll()->each(function($node) {
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
					case '11':
						unset($rating[0]);
						unset($rating[1]);
						unset($rating[2]);
						unset($rating[3]);
						unset($rating[4]);
						$rating = array_values($rating);
						break;
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

				// other values that we need to filter on
				$values = array(
					'club_id' => $clubId,
					'tee_name' => $rating[1],
					'tee_sex' => $rating[2],
					'par' => (int)$rating[3],
					'scratch' => (int)$rating[4],
					'holes' => $holes,
					'slope' => (int)$rating[5]
				);

				$ratings[] = $values;
			}
		}
		return $ratings;
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
					'club_id' 	=> $rating['club_id'],
					'tee_name' 	=> $rating['tee_name'],
					'tee_sex' 	=> $rating['tee_sex'],
					'par' 			=> (int)$rating['par'],
					'scratch' 	=> (int)$rating['scratch'],
					'slope' 		=> (int)$rating['slope'],
					'holes' 		=> $rating['holes']
				);

				if(count($check_rating) == 0) {
					$inserted = $this->rating->create($values);
					if($inserted) {
						$action[] = $inserted;
					}
				} else {
					if($check_rating) {
						// This needs to be fix idiot (why would I do this)?
						foreach($check_rating as $updateRatings) {
							$check = array(
								'club_id' 	=> $updateRatings->club_id,
								'par' 			=> (int)$updateRatings->par,
								'tee_name' 	=> $updateRatings->tee_name,
								'tee_sex' 	=> $updateRatings->tee_sex,
								'holes' 		=> $updateRatings->holes,
								'scratch' 	=> (int)$updateRatings->scratch,
								'slope' 		=> (int)$updateRatings->slope
							);

							if(array_diff_assoc($values, $check)) {
								$updated = $this->rating->update($values, $updateRatings->id);
								if($updated) {
									$action[] = $updated;
								}
							}
						}
					}
				}
			}
		}
		return $action;
	}
}