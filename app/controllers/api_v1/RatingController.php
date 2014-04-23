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
	 * @param $clubId
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
		$this->doSomething($clubId);

		return \View::make('api.rating.fetch');
	}

	public function doSomething($clubId)
	{
		$club = Club::find($clubId);

		$ratings = new Ratings($club->name, $state = "QLD", $clubId, $this->rating, $this->club);
		$course = $ratings->checkCourse();

		$total_ratings = $ratings->getRatings();

//		$rating = $this->rating->where('club_id', '=', $clubId)->get();
	}
}