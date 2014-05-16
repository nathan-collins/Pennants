<?php

use Magniloquent\Magniloquent\Magniloquent;

class Competition extends Magniloquent
{
	protected $table = "competitions";

	protected $guarded = array('id');

	protected $fillable = array('name');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
		),
		"create" => array(),
		"update" => array()
	);

	protected static $relationships = array(
		'seasons' => array('hasMany', 'Season'),
	);
}