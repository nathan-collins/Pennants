<?php

use Magniloquent\Magniloquent\Magniloquent;

class PlayerResult extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('player_id', 'grade_id', 'season_id', 'game_id', 'hole', 'score', 'status', 'finished');

	public static $rules = array();

	protected static $relationships = array(
		'player' => array('hasOne', 'Player', 'player_id'),
		'player_season' => array('hasOne', 'PlayerSeason', 'player_id')
	);
}
