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

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			$game = Game::where($column, '=', $value);
		}

		return $game->orderBy('game_date')->get();
	}


	public function getRecent($limit)
	{
		return Game::take($limit)->get();
	}

	public function create($data)
	{
		$game = new Game($data);

		$game->save($game->toArray());

		return $game;
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