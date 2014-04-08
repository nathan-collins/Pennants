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

	public function fetchRatings($clubId)
	{
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