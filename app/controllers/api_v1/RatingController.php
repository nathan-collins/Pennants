<?php namespace api_v1;

use Pennants\Rating\RatingRepositoryInterface;
use Ratings;
use Club;
use Rating;
use Pennants\Club\ClubRepositoryInterface;

class RatingController extends \BaseController {

	public function __construct(RatingRepositoryInterface $rating, ClubRepositoryInterface $club) {
		$this->club = $club;
		$this->rating = $rating;
	}

	/**
	 * @return mixed
	 */

	public function index()
	{
		$ratings = $this->rating->all();

		return $ratings;
	}

	public function getRatingByClub($club_id)
	{
		if(empty($club_id)) {
			return \Response::json(array(
				'error' => true,
				'rating' => array('message' => "No club supplied"),
				'code' 	=> 400
			));
		}

		$ratings = $this->rating->getWhere(array('club_id' => $club_id));

		return $ratings;
	}

	public function fetchRatings($clubId)
	{
		$data = $this->doSomething($clubId);

		if(!$data) {
			return \Response::json(array(
				'error' => true,
				'message' => "The course you entered could not be found.",
				'code' 	=> 400
			));
		} else {
			return \Response::json(array(
				'error' => false,
				'message' => "The course you entered was successfully added.",
				'code' 	=> 200
			));
		}
	}

	public function doSomething($clubId)
	{
		$club = Club::find($clubId);

		$ratings = new Ratings($club->name, $state = "QLD", $clubId, $this->rating, $this->club);
		$course = $ratings->checkCourse();

		if(!empty($course)) {
			$total_ratings = $ratings->getRatings();
		} else {
			return false;
		}
	}
}