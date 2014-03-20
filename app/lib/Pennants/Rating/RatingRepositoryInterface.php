<?php namespace Pennants\Rating;


interface RatingRepositoryInterface {
	public function all();
	public function find($id);
}