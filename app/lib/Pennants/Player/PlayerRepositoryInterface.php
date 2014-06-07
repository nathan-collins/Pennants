<?php namespace Pennants\Player;

interface PlayerRepositoryInterface {
	public function all();
	public function find($id);
	public function update($id);
	public function delete($id);
	public function create($data);
	public function searchPlayerByName($name);
	public function getPlayerById($playerId);
}