<?php

use Magniloquent\Magniloquent\Magniloquent;

class Result extends Magniloquent {
	protected $guarded = array();

	public static $rules = array(
		"save" => array(
			'game_id' => 'required|numeric',
			'player_id'	=> 'required|numeric',
			'versus_id' => 'required|numeric'
		),
		"create" => array(
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
}
