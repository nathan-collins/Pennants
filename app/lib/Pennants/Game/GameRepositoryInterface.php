<?php namespace Pennants\Game;


interface GameRepositoryInterface {
	public function errors();

	public function all();

	public function find($id);

	public function getWhere($rows);

	public function getRecent($limit);

	public function create($data);

	public function update($id, $data);

	public function delete($id);

	public function deleteWhere($column, $value);
}