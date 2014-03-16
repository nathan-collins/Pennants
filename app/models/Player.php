<?php

use Magniloquent\Magniloquent\Magniloquent;

class Player extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'handicap', 'settings', 'golf_link_number');

	protected static $relationships = array(
		'player_season' => array('hasMany', 'Player')
	);

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'handicap' => 'required',
			'golf_link_number' => 'required|numeric|digits:10'
		),
		"create" => array(
			'name' => 'required',
			'handicap' => 'required',
			'golf_link_number' => 'required|numeric|digits:10'
		),
		"update" => array()
	);
}
