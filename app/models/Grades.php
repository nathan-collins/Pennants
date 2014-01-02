<?php

use Magniloquent\Magniloquent\Magniloquent;

class Grades extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name');

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
