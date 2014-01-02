<?php

use Magniloquent\Magniloquent\Magniloquent;

class Clubs extends Magniloquent {
	protected $guarded = array('id');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'season_id' => 'required|numeric'
		),
		"create" => array(
			'name' => 'required',
			'season_id' => 'required'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'region' => array('belongsTo', 'Season', 'season_id')
	);
}
