<?php namespace Pennants\Club;

use Club;
use Match;
use Game;
use Illuminate\Support\Collection;

class DbClubRepository implements ClubRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return Club::orderBy('name')->get();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function find($id)
	{
		return Club::find($id);
	}

	/**
	 *
	 *
	 * @param array $rows
	 * @return mixed
	 */

	public function getWhere($rows)
	{
		foreach($rows as $column => $value) {
			$club = Club::where($column, '=', $value);
		}

		return $club->orderBy('name')->get();
	}

	/**
	 * @param $seasonId
	 * @param $gradeId
	 * @return int
	 */

	public function countClubs($seasonId, $gradeId) {
		$clubs = $this->season($seasonId)->grade($gradeId)->count();
		return $clubs;
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function update($id)
	{
		$club = $this->get($id);

		$club->save(\Input::all());

		return $club;
	}

	/**
	 * @param $name
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
	 */

	public function updateName($name, $id)
	{
		$club = Club::find($id);

		$club->name = $name;

		$club->save();

		return $club;
	}

	/**
	 * @param $status
	 * @param $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
	 */

	public function updateStatus($status, $id)
	{
		$club = Club::find($id);

		$club->active = 'Y';

		if($status == 'disabled') {
			$club->active = 'N';
		}

		$club->save();

		return $club;
	}

	/**
	 * @param $id
	 *
	 * @return bool
	 */

	public function delete($id)
	{
		$club = $this->get($id);

		if(!$club) {
			return false;
		}

		return $club->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$club = new Club($data);

		$exists = $this->getClubByParams($club->name, $club->season_id, $club->grade_id)->first();

		if(count($exists) == 0) {
			$club->save($club->toArray());
		} else {
			foreach($exists as $club) {
				$club = $club;
			}
		}

		return $club;
	}

	/**
	 * @param $name
	 * @param $season_id
	 * @param $grade_id
	 * @return mixed
	 */
	public function getClubByParams($name, $season_id, $grade_id)
	{
		return Club::getName($name)->getSeason($season_id)->getGrade($grade_id)->getActive('Y');
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @return mixed
	 */
	public function getActiveClubs($season_id, $grade_id)
	{
		return Club::getSeason($season_id)->getGrade($grade_id)->getActive('Y')->orderBy('name');
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @param $game_id
	 * @return array
	 */
	public function getFilteredClubsByGame($season_id, $grade_id, $game_id)
	{
		$clubs = Club::select('id', 'name')->getSeason($season_id)->getGrade($grade_id)->getActive('Y')->get();
		$matches = Match::select('club_id', 'opponent_id')->getSeason($season_id)->getGrade($grade_id)->getGame($game_id)->lists('club_id', 'opponent_id');
		$existing = list($keys, $values) = array_divide($matches);
		$existing = array_flatten($existing);
		$newClubs = new Collection();
		$key = 0;
		foreach($clubs as $index => $club) {
			if(!in_array($club->id, $existing)) {
				array_add($newClubs, $key, $club);
				$key++;
			}
		}
		return $newClubs;
	}

	/**
	 * @param $season_id
	 * @param $grade_id
	 * @return array
	 */
	public function getFilteredClubs($season_id, $grade_id)
	{
		$clubs = Club::select('id', 'name')->getSeason($season_id)->getGrade($grade_id)->getActive('Y')->get();
		$matches = Game::select('host_id')->getSeason($season_id)->getGrade($grade_id)->lists('host_id');

		$key = 0;

		$newClubs = new Collection();
		foreach($clubs as $index => $club) {
			if(!in_array($club->id, $matches)) {
				array_add($newClubs, $key, $club);
				$key++;
			}
		}
		return $newClubs;
	}
}