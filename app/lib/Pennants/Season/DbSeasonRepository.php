<?php namespace Pennants\Season;

use Illuminate\Support\Facades\Config;
use Season;

class DbSeasonRepository implements SeasonRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		$competition_id = Config::get('pennants.competition_id');
		if(!$competition_id) {
			return \Response::json(array(
				'error' => true,
				'season' => array('message' => "Competition ID is required"),
				'code' 	=> 400
			));
		}
		return Season::select('seasons.id AS season_id', 'seasons.*', 'competitions.*')
			->leftJoin('competitions', 'competitions.id', '=', 'seasons.competition_id')
			->where('seasons.competition_id', '=', $competition_id)
			->orderBy('year', 'DESC')
			->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		$season = Season::leftJoin('competitions', 'competitions.id', '=', 'seasons.competition_id')
			->where('seasons.id', '=', $id)
			->first();
		return $season;
	}

	/**
	 * Update season entry
	 *
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$season = $this->get($id);

		$season->save(\Input::all());

		return $season;
	}

	public function delete($id)
	{
		$season = $this->get($id);

		if(!$season) {
			return false;
		}

		return $season->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$season = new Season($data);

		$season->save($season->toArray());

		return $season;
	}

	public function getSeasonId($alias, $year)
	{
		return Season::getSeasonId($alias, $year);
	}
}