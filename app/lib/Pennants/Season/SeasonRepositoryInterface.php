<?php namespace Pennants\Season;

interface SeasonRepositoryInterface {
	public function all();
	public function find($id);
	public function update($id);
	public function delete($id);
	public function create($data);
	public function getSeasonId($alias, $year);
}