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
}
