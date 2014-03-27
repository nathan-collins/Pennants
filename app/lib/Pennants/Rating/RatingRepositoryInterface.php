<?php namespace Pennants\Rating;


interface RatingRepositoryInterface {
	public function all();
	public function find($id);
	public function getWhere($rows);
	public function create($data);
	public function getRating($tee_name, $tee_sex, $club_id, $holes);
}