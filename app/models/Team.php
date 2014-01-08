<?php

class Team extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		"save" => array(
			'player_id' => 'required|numeric',
			'game_id' => 'required|numeric'
		),
		"create" => array(
			'player_id' => 'required|numeric',
			'game_id' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'player_season' => array('belongsTo', 'PlayerSeason', 'player_id'),
		'game' => array('belongsTo', 'Game', 'game_id'),
	);
}
