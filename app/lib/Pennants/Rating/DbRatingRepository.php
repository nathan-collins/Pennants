<?php namespace Pennants\Rating;

use Rating;

class DbRatingRepository implements RatingRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Rating::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Rating::find($id);
	}
}