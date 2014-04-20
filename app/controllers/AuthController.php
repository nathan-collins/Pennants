<?php
use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class AuthController extends BaseController {
	public function showLogin()
	{
		JavaScript::put([
			'CSRF_TOKEN' => csrf_token()
		]);

		return \View::make('users.login');
	}
}