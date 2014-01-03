<?php

use Magniloquent\Magniloquent\Magniloquent;

class Results extends Magniloquent {
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
		'game' => array('belongsTo', 'Games', 'game_id'),
		'player_season' => array('belongsTo', 'PlayerSeasons', 'player_id', 'versus_id'),
	);
}
