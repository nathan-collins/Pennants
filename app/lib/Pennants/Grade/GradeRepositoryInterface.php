<?php namespace Pennants\Grade;
/**
 * Created by IntelliJ IDEA.
 * User: nathancollins
 * Date: 22/12/13
 * Time: 3:44 PM
 * To change this template use File | Settings | File Templates.
 */

interface GradeRepositoryInterface {
	public function all();
	public function find($id);
	public function getSettings($seasonId, $gradeId);
	public function update($id);
	public function countGrades($seasonId);
	public function delete($id);
	public function create($data);
	public function getGrades($seasonId);
}