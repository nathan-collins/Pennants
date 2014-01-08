<?php namespace Pennants\Game;

use Game;

class DbGameRepository implements GameRepositoryInterface {

	public function errors()
	{
		return;
	}

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Game::all();
	}


	public function find($id)
	{
		return Game::find($id);
	}

	public function getWhere($column, $value)
	{
		return Game::where($column, $value)->get();
	}


	public function getRecent($limit)
	{
		return Game::take($limit)->get();
	}

	public function create($data)
	{
		$games = new Game;

		foreach($data as $games_key => $games_data) {
			$games->$games_key = $games_data;
		}

		return $games->save();
	}

	public function update($id, $data)
	{
		$games = Game::find($id);

		foreach($data as $games_key => $games_data) {
			$games->$games_key = $games_data;
		}

		return $games->save();
	}

	public function delete($id)
	{
		Game::find($id);

		return Game::delete();
	}

	public function deleteWhere($column, $value)
	{
		return Game::where($column, $value)->delete();
	}
}