<?php namespace Pennants\Competition;

interface CompetitionRepositoryInterface {
	public function all();
	public function find($id);
}
