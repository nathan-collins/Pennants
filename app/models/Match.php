<?php

use Magniloquent\Magniloquent\Magniloquent;

class Match extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id', 'game_time', 'club_id', 'opponent_id');

	protected static $relationships = array(
		'game' => array('hasOne', 'Game', 'host_id')
	);

	public function scopeJoinGame($query)
	{
		$query->leftJoin('games', 'matches.game_id', '=', 'games.id');
	}

	/**
	 * @param $query
	 * @param $season_id
	 */
	public function scopeGetSeason($query, $season_id) {
		$query->where('matches.season_id', '=', $season_id);
	}

	/**
	 * @param $query
	 * @param $grade_id
	 */
	public function scopeGetGrade($query, $grade_id) {
		$query->where('matches.grade_id', '=', $grade_id);
	}

	/**
	 * @param $query
	 * @param $game_id
	 */
	public function scopeGetHost($query, $game_id) {
		$query->where('matches.game_id', '=', $game_id);
	}

	/**
	 * @param $query
	 * @param $match_id
	 */
	public function scopeGetGame($query, $game_id) {
		$query->where('matches.game_id', '=', $game_id);
	}

	/**
	 * @param $query
	 * @param $club_id
	 */
	public function scopeGetClubOrOpponent($query, $club_id)
	{
		$query->where('matches.club_id', '=', $club_id)->orWhere('matches.opponent_id', '=', $club_id);
	}
}
