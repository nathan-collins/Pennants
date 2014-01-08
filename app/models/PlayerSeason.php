<?php

class PlayerSeason extends Eloquent {
	protected $guarded = array();

	protected $fillable = array();

	protected $softDelete = true;

	public static $rules = array(
		"save" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric'
		),
		"create" => array(
			'player_id' => 'required|numeric',
			'season_id' => 'required|numeric',
			'club_id'	=> 'required|numeric',
			'grade_id' => 'required|numeric'
		),
		"update" => array()
	);
}
