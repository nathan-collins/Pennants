<?php namespace api_v1;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class AuthController extends \BaseController
{

	/**
	 * @return mixed
	 */

	public function status()
	{
		return Response::json(Auth::check());
	}

	public function secrets() {
		if(Auth::check()) {
			return 'You are logged in, here are secrets.';
		} else {
			return 'You aint logged in, no secrets for you.';
		}
	}

	public function login()
	{
		JavaScript::put([
			'CSRF_TOKEN' => csrf_token()
		]);

		if(Auth::attempt(array('username' => Input::json('username'), 'password' => Input::json('password'))))
		{
			return Response::json(Auth::user());
		} else {
			return Response::json(array('flash' => 'Invalid username or password'), 500);
		}
	}

	public function logout()
	{
		Auth::logout();
		return Response::json(array('flash' => 'Logged Out!'));
	}
}