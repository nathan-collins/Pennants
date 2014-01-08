<?php

use Magniloquent\Magniloquent\Magniloquent;

class Game extends Magniloquent {
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
		'club' => array('belongsTo', 'Club', 'club_id'),
		'host' => array('belongsTo', 'Club', 'host_id'),
		'opponent' => array('belongsTo', 'Player', 'opponent_id'),
		'versus' => array('belongsTo', 'Player', 'versus_id'),
		'player' => array('belongsTo', 'Player', 'player_id'),
	);
}
