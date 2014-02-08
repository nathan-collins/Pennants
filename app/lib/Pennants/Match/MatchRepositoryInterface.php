<?php namespace Pennants\Match;

interface GradeRepositoryInterface {
	public function all();
	public function find($id);
	public function getWhere($column, $value);
	public function update($id);
	public function delete($id);
	public function create($data);
}