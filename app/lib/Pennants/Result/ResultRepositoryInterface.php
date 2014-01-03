<?php namespace Pennants\Result;


interface ResultRepositoryInterface {
	public function all();
	public function get($id);
}