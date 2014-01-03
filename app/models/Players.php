<?php

use Magniloquent\Magniloquent\Magniloquent;

class Players extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('name', 'settings', 'golf_link_number');

	public static $rules = array(
		"save" => array(
			'name' => 'required',
			'golf_link_number' => 'required|numeric'
		),
		"create" => array(
			'name' => 'required',
			'golf_link_number' => 'required|numeric'
		),
		"update" => array()
	);

	protected static $relationships = array(
		'user' => array('belongsTo', 'User', 'user_id'),
		'region' => array('belongsTo', 'Season', 'season_id'),
		'club' => array('belongsTo', 'Club', 'club_id')
	);
}
