<?php

use Magniloquent\Magniloquent\Magniloquent;

class Player extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'handicap', 'settings', 'golf_link_number');

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
