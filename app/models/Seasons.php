<?php

use Magniloquent\Magniloquent\Magniloquent;

class Seasons extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'year');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'year' => 'required|numeric'
		),
		"create" => array(
			'name' => 'required',
			'year' => 'required|numeric'
		),
		"update" => array()
	);
}
