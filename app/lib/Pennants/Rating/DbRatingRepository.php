<?php namespace Pennants\Rating;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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

	/**
	 * @param $rows
	 * @return mixed
	 */

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			$rating = Rating::wheres($column, '=', $value);
		}
		return $rating->get();
	}

	/**
	 * @param $data
	 *
	 * @return Ratings
	 */

	public function create($data)
	{
		$rating = new Rating($data);

		$rating->save($rating->toArray());

		return $rating;
	}

	public function update($data, $id)
	{
		$rating = Rating::find($id);

		$rating->save($data);

		return $rating;
	}

	/**
	 * @param $tee_name
	 * @param $tee_sex
	 * @param $club_id
	 * @param $holes
	 * @return mixed
	 */

	public function getRating($tee_name, $tee_sex, $club_id, $holes)
	{
		return Rating::getRating($tee_name, $tee_sex, $club_id, $holes);
	}
}