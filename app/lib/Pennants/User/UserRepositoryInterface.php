<?php namespace Pennants\User;

interface UserRepositoryInterface {
	public function all();
	public function get($id);
	public function update($id);
	public function delete($id);
	public function create($data);
}