<?php

use Magniloquent\Magniloquent\Magniloquent;

class Player extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'settings');

	protected static $relationships = array(
		'player_season' => array('hasMany', 'Player')
	);

	public static $rules = array(
		"save" => array(
			'name' => 'required',
		),
		"create" => array(
			'name' => 'required',
		),
		"update" => array()
	);
}
