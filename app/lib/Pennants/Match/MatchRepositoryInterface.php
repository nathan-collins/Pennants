<?php namespace Pennants\Match;

interface MatchRepositoryInterface {
	public function all();
	public function find($id);
	public function getWhere($rows);
	public function update($id);
	public function delete($id);
	public function create($data);
}