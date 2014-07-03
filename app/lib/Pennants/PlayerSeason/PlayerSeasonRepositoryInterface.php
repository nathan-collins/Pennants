<?php namespace Pennants\PlayerSeason;


interface PlayerSeasonRepositoryInterface {
	public function all();
	public function find($id);
	public function getPlayerByParams($season_id, $grade_id, $club_id);
	public function getPlayerHandicap($player_id);
}