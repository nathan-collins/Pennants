<?php namespace Api;

use Pennants\User\UserRepositoryInterface;

class UserController extends \BaseController {

	protected $user;

	public function __construct(UserRepositoryInterface $user)
	{
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = $this->user->all();

		return \Response::json(array(
			'error' => false,
			'season' => $user->toArray(),
			'code'	=> 200
		));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$s = $this->user->create(\Input::all());

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.user.index')
				->with('flash', 'A new season has been created');
		}

		return \Redirect::route('api.v1.pennants.user.create')
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = $this->user->find($id);

		return \Response::json(array(
			'error' => false,
			'season' => $user->toArray(),
			'code' 	=> 200
		));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);

		return \View::make('user.edit')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$s = $this->user->update($id);

		if($s->isSaved()) {
			return \Redirect::route('api.v1.pennants.user.show', $id)
				->with('flash', 'The season was updated');
		}

		return \Redirect::route('api.v1.pennants.user.edit', $id)
			->withInput()
			->withErrors($s->errors());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->user->delete($id);

		return \Response::json(array(
			'error' => false,
			'season' => $user,
			'code' 	=> 200
		));
	}

	/**
	 *
	 */

	public function login()
	{
		$user = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if(Auth::attempt($user)) {

		}
	}

}