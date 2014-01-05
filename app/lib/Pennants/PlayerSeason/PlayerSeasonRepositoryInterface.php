<?php namespace Pennants\PlayerSeason;


interface PlayerSeasonRepositoryInterface {
	public function all();
	public function find($id);
}