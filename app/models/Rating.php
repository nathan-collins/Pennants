<?php

use Magniloquent\Magniloquent\Magniloquent;

class Rating extends Magniloquent
{
	protected $fillable = array('club_id', 'tee_name', 'tee_sex', 'ratings', 'holes');

	public static $rules = array(
		"save" => array(
			'club_id' => 'required|numeric'
		),
		"create" => array(
			'club_id' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'club' => array('belongsTo', 'Club', 'club_id')
	);

	/**
	 * @param $query
	 * @param $tee_name
	 * @param $tee_sex
	 * @param $club_id
	 * @param $holes
	 * @return mixed
	 */

	public function scopeGetRating($query, $tee_name, $tee_sex, $club_id, $holes)
	{
		$rating = $query->where('tee_name', $tee_name);
			$query->where('tee_sex', $tee_sex);
			$query->where('club_id', $club_id);
			$query->where('holes', $holes);
		return $rating->get();
	}
}