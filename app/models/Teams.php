<?php

class Teams extends Eloquent {
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
		'player_season' => array('belongsTo', 'PlayerSeasons', 'player_id'),
		'game' => array('belongsTo', 'Games', 'game_id'),
	);
}
