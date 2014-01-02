<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
	Route::resource('pennants/season', 'Api\SeasonController');
	Route::resource('pennants/grade', 'Api\GradeController');
	Route::get('pennants/grade/seasons/{id}', 'Api\GradeController@getSeasons');
	Route::resource('pennants/club', 'Api\ClubController');
	Route::get('pennants/club/seasons/{id}', 'Api\ClubController@getSeasons');
	Route::resource('pennants/game', 'Api\GameController');
	Route::resource('pennants/result', 'Api\ResultController');
	Route::resource('pennants/player_result', 'Api\PlayerResultController');
	Route::resource('pennants/user', 'Api\UserController');
});

Route::get('/', array('as' => 'home', function () {
	return View::make('home.home');
}));

Route::get('login', array('as' => 'login', function () {
	return View::make('users.login');
}))->before('guest');

Route::post('login', function () {
	$user = array(
		'username' => Input::get('username'),
		'password' => Input::get('password')
	);

	if (Auth::attempt($user)) {
		return Redirect::route('home')
			->with('flash_notice', 'You are successfully logged in.');
	}

	// authentication failure! lets go back to the login page
	return Redirect::route('login')
		->with('flash_error', 'Your username/password combination was incorrect.')
		->withInput();
});

Route::get('logout', array('as' => 'logout', function () {
	Auth::logout();

	return Redirect::route('home')
		->with('flash_notice', 'You are successfully logged out.');
}))->before('auth');

Route::get('profile', array('as' => 'profile', function () {
	return View::make('users.profile');
}))->before('auth');