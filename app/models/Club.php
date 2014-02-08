<?php

use Magniloquent\Magniloquent\Magniloquent;

class Club extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id', 'name');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'season_id' => 'required|numeric',
			'grade_id' => 'required|numeric'
		),
		"create" => array(
			'name' => 'required',
			'season_id' => 'required',
			'grade_id' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'region' => array('belongsTo', 'Season', 'season_id'),
		'grade' => array('belongsTo', 'Grade', 'grade_id')
	);
}
