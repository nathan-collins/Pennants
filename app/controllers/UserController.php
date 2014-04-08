<?php

class UserController extends BaseController
{
	public function showProfile()
	{
		return \View::make('users.profile');
	}
}