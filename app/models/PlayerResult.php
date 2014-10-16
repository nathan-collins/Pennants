<?php

use Magniloquent\Magniloquent\Magniloquent;

class PlayerResult extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('player_id', 'grade_id', 'season_id', 'match_id', 'club_id', 'hole', 'score', 'availability', 'finished');

	public static $rules = array(
		"save" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'match_id' => 'required|numeric',
			'player_id'	=> 'required|numeric',
			'club_id'	=> 'required|numeric'
		),
		"create" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'match_id' => 'required|numeric',
			'player_id'	=> 'required|numeric',
			'club_id'	=> 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'player' => array('hasOne', 'Player', 'player_id'),
		'player_season' => array('hasOne', 'PlayerSeason', 'player_id'),
		'result' => array('hasMany', 'Result', 'player_id', 'versus_id')
	);

	public function scopeGetPlayer($query, $player_id)
	{
		return $query->where('player_id', '=', $player_id);
	}

	/**
	 * @param $query
	 * @param $season_id
	 * @return mixed
	 */
	public function scopeGetSeason($query, $season_id)
	{
		return $query->where('season_id', '=', $season_id);
	}

	/**
	 * @param $query
	 * @param $grade_id
	 * @return mixed
	 */
	public function scopeGetGrade($query, $grade_id)
	{
		return $query->where('grade_id', '=', $grade_id);
	}

	/**
	 * @param $query
	 * @param $club_id
	 * @return mixed
	 */

	public function scopeGetClub($query, $club_id)
	{
		return $query->where('club_id', '=', $club_id);
	}

	/**
	 * @param $query
	 * @param $match_id
	 * @return mixed
	 */
	public function scopeGetMatch($query, $match_id)
	{
		return $query->where('match_id', '=', $match_id);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeFilterAvailability($query)
	{
		return $query->where('availability', '=', 'Yes');
	}
}
