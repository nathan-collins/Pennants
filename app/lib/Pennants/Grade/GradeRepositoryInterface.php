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
	public function getWhere($column, $value);
	public function update($id);
	public function delete($id);
	public function create($data);
}