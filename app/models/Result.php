<?php

use Magniloquent\Magniloquent\Magniloquent;

class Result extends Magniloquent {
	protected $guarded = array();

	protected $fillable = array('season_id', 'grade_id', 'game_id', 'player_id', 'versus_id', 'result');

	public static $rules = array(
		"save" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'game_id' => 'required|numeric',
			'player_id'	=> 'required|numeric',
			'versus_id' => 'required|numeric'
		),
		"create" => array(
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric',
			'game_id' => 'required|numeric',
			'player_id'	=> 'required|numeric',
			'versus_id' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'game' => array('belongsTo', 'Game', 'game_id'),
		'player_season' => array('belongsTo', 'PlayerSeason', 'player_id', 'versus_id'),
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
	 * @param $game_id
	 * @return mixed
	 */
	public function scopeGetMatch($query, $game_id)
	{
		return $query->where('game_id', '=', $game_id);
	}
}
