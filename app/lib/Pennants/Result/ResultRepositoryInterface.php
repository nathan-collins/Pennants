<?php namespace Pennants\Result;


interface ResultRepositoryInterface {
	public function all();
	public function find($id);
	public function create($data);
	public function getResultsByParams($season_id, $grade_id, $match_id);
}