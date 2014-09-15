<?php namespace Pennants\Result;


interface ResultRepositoryInterface {
	public function all();
	public function find($id);
	public function create($data);
	public function update($data, $result_id);
	public function updatePosition($set_data, $match_id, $position);
	public function getResultsByParams($season_id, $grade_id, $match_id);
}