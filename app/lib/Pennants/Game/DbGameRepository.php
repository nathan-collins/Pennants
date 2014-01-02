<?php namespace Pennants\Game;

use Games;

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
		return Games::all();
	}


	public function get($id)
	{
		return Games::find($id);
	}

	public function getWhere($column, $value)
	{
		return Games::where($column, $value)->get();
	}


	public function getRecent($limit)
	{
		return Games::take($limit)->get();
	}

	public function create($data)
	{
		$games = new Games;

		foreach($data as $games_key => $games_data) {
			$games->$games_key = $games_data;
		}

		return $games->save();
	}

	public function update($id, $data)
	{
		$games = Games::find($id);

		foreach($data as $games_key => $games_data) {
			$games->$games_key = $games_data;
		}

		return $games->save();
	}

	public function delete($id)
	{
		Games::find($id);

		return Games::delete();
	}

	public function deleteWhere($column, $value)
	{
		return Games::where($column, $value)->delete();
	}
}