<?php

use Magniloquent\Magniloquent\Magniloquent;

class Result extends Magniloquent {
	protected $guarded = array();

	protected $fillable = array('season_id', 'grade_id', 'match_id', 'player_id', 'versus_id', 'result', 'position', 'status');

	public static $rules = array(
		"save" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'match_id' => 'required|numeric',
		),
		"create" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'match_id' => 'required|numeric',
		),
		"update" => array()
	);

	protected static $relationships = array(
		'game' => array('belongsTo', 'Game', 'game_id'),
		'player_season' => array('belongsTo', 'PlayerSeason', 'player_id', 'versus_id')
	);

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
	 * @param $match_id
	 * @return mixed
	 */
	public function scopeGetMatch($query, $match_id)
	{
		return $query->where('match_id', '=', $match_id);
	}

	/**
	 * @param $query
	 * @param $player_id
	 * @return mixed
	 */
	public function scopeGetPlayer($query, $player_id)
	{
		return $query->where('player_id', '=', $player_id)->orWhere('versus_id', '=', $player_id);
	}

	/**
	 * @param $query
	 * @param $position
	 * @return mixed
	 */
	public function scopeGetPosition($query, $position)
	{
		return $query->where('position', '=', $position);
	}

	/**
	 * @param $query
	 * @return mixed
	 */
	public function scopeFilterStatus($query)
	{
		return $query->where('status', '=', 'Yes');
	}
}
