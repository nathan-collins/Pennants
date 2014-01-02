<?php

use Magniloquent\Magniloquent\Magniloquent;

class Games extends Magniloquent {
	protected $guarded = array('id');

	public static $rules = array(
		"save" => array(
			'club_id'	=> 'required|numeric',
			'opponent_id' => 'required|numeric',
			'host_id'			=> 'required|numeric',
			'player_id'		=> 'required|numeric',
			'versus_id'		=> 'required|numeric'
		),
		"create" => array(
			'club_id'	=> 'required|numeric',
			'opponent_id' => 'required|numeric',
			'host_id'			=> 'required|numeric',
			'player_id'		=> 'required|numeric',
			'versus_id'		=> 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'club' => array('belongsTo', 'Clubs', 'club_id'),
		'host' => array('belongsTo', 'Clubs', 'host_id'),
		'opponent' => array('belongsTo', 'Players', 'opponent_id'),
		'versus' => array('belongsTo', 'Players', 'versus_id'),
		'player' => array('belongsTo', 'Players', 'player_id'),
	);
}
