<?php

use Magniloquent\Magniloquent\Magniloquent;

class Match extends Magniloquent {
	protected $guarded = array('id');

	protected $fillable = array('season_id', 'grade_id');

	/**
	 * @param $season_id
	 */
	public function scopeGetSeason($season_id) {
		Match::where('season_id', '=', $season_id);
	}

	/**
	 * @param $grade_id
	 */
	public function scopeGetGrade($grade_id) {
		Match::where('grade_id', '=', $grade_id);
	}

	/**
	 * @param $club_id
	 */
	public function scopeGetClub($club_id) {
		Match::where('club_id', '=', $club_id);
	}
}
