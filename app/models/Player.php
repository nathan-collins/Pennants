<?php

use Magniloquent\Magniloquent\Magniloquent;

class Player extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'settings');

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
