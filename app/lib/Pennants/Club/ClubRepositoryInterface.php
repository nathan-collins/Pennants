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
	public function get($id);
	public function getWhere($column, $value);
	public function update($id);
	public function delete($id);
	public function create($data);
}