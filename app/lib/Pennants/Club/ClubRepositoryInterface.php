<?php namespace Pennants\Club;

/**
 * Created by IntelliJ IDEA.
 * User: nathancollins
 * Date: 22/12/13
 * Time: 10:23 AM
 * To change this template use File | Settings | File Templates.
 */

interface ClubRepositoryInterface {
	public function all();
	public function find($id);
	public function getWhere($rows);
	public function update($id);
	public function updateName($name, $id);
	public function updateStatus($status, $id);
	public function countClubs($seasonId, $gradeId);
	public function delete($id);
	public function create($data);
	public function getClubByParams($name, $season_id, $grade_id);
}