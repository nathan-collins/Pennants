<?php namespace Pennants\User;

use User;

class DbUserRepository implements UserRepositoryInterface {

	/**
	 * @return mixed
	 */

	public function all()
	{
		return User::all();
	}

	/**
	 * @param $id
	 *
	 * @return mixed
	 */

	public function get($id)
	{
		return User::find($id);
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
		$user = $this->get($id);

		$user->save(\Input::all());

		return $user;
	}

	public function delete($id)
	{
		$user = $this->get($id);

		if(!$user) {
			return false;
		}

		return $user->delete();
	}

	/**
	 * @param $data
	 *
	 * @return Seasons
	 */

	public function create($data)
	{
		$user = new User($data);

		$user->save($user->toArray());

		return $user;
	}
}