<?php

use Magniloquent\Magniloquent\Magniloquent;

class Competition extends Magniloquent
{
	protected $guarded = array('id');

	protected $fillable = array('name');

	protected static $relationships = array(
		'season' => array('hasMany', 'Competition'),
	);
}