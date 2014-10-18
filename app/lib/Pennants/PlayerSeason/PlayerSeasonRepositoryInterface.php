<?php namespace Pennants\PlayerSeason;


interface PlayerSeasonRepositoryInterface {
	public function all();
	public function find($id);
	public function getPlayerBySeasons($season_id, $grade_id, $club_id);
	public function getPlayerHandicap($season_id, $grade_id, $player_id);
	public function getPlayerByPlayerId($season_id, $grade_id, $player_id);
	public function updateHandicap($handicap, $data, $player_id);
}