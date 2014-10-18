<?php
/**
 * Created by IntelliJ IDEA.
 * User: nathancollins
 * Date: 22/12/13
 * Time: 11:46 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Pennants\PlayerResult;


interface PlayerResultRepositoryInterface {
	public function all();
	public function find($id);
	public function create($data);
	public function playerExists($player_id, $season_id, $grade_id, $match_id);
	public function updateHandicap($current_handicap, $id, $player_id);
	public function getPlayerByPlayerId($season_id, $grade_id, $match_id, $player_id);
	public function getPlayerByResults($season_id, $grade_id, $club_id);
	public function getPlayerHandicap($season_id, $grade_id,$player_id);
	public function getPlayerByMatch($season_id, $grade_id, $club_id, $match_id, $player_id);
	public function updateAvailability($availability, $data, $player_id);
}