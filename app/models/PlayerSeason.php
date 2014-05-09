<?php

use Magniloquent\Magniloquent\Magniloquent;

class PlayerSeason extends Magniloquent {
	protected $guarded = array('*');

	protected $fillable = array('handicap', 'golf_link_number', 'player_id', 'season_id', 'club_id', 'grade_id');

	protected $softDelete = true;

	/**
	 * @var array
	 */
	public static $rules = array(
		"save" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric',
			'handicap' => 'required',
			'golf_link_number' => 'numeric|digits:10'
		),
		"create" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric',
			'handicap' => 'required',
			'golf_link_number' => 'numeric|digits:10'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'player' => array('hasMany', 'PlayerSeason', 'player_id')
	);

	/**
	 * @param $query
	 * @param $season_id
	 * @return mixed
	 */
	public function scopeSeason($query, $season_id)
	{
		return $query->where('season_id', '=', $season_id);
	}

	/**
	 * @param $query
	 * @param $grade_id
	 * @return mixed
	 */
	public function scopeGrade($query, $grade_id)
	{
		return $query->where('grade_id', '=', $grade_id);
	}

	/**
	 * @param $query
	 * @param $club_id
	 * @return mixed
	 */

	public function scopeClub($query, $club_id)
	{
		return $query->where('club_id', '=', $club_id);
	}
}
