<?php

use Magniloquent\Magniloquent\Magniloquent;

class Game extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id', 'game_date', 'host_id');

	public static $rules = array(
		"save" => array(
			'game_date'	=> 'required',
			'host_id'			=> 'required|numeric',
			'season_id'		=> 'required|numeric',
			'grade_id'		=> 'required|numeric'
		),
		"create" => array(
			'game_date'	=> 'required',
			'host_id'			=> 'required|numeric',
			'season_id'		=> 'required|numeric',
			'grade_id'		=> 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'host' => array('belongsTo', 'Club', 'host_id'),
		'season' => array('belongsTo', 'Season', 'season_id'),
		'grade' => array('belongsTo', 'Grade', 'grade_id')
	);

	/**
	 * @param $query
	 * @param $host_id
	 */
	public function scopeGetHost($query, $host_id)
	{
		$query->where('games.host_id', '=', $host_id);
	}

	/**
	 * @param $query
	 * @param $season_id
	 */
	public function scopeGetSeason($query, $season_id)
	{
		$query->where('games.season_id', '=', $season_id);
	}

	/**
	 * @param $query
	 * @param $grade_id
	 */
	public function scopeGetGrade($query, $grade_id)
	{
		$query->where('games.grade_id', '=', $grade_id);
	}
}
