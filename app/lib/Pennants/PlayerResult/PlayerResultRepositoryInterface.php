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
}