<?php

class PlayerSeason extends Eloquent {
	protected $guarded = array('*');

	protected $fillable = array('handicap', 'golf_link_number');

	protected $softDelete = true;

	public static $rules = array(
		"save" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric',
			'handicap' => 'required',
			'golf_link_number' => 'required|numeric|digits:10'
		),
		"create" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric',
			'handicap' => 'required',
			'golf_link_number' => 'required|numeric|digits:10'
		),
		"update" => array()
	);
}
