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
	Route::resource('pennants/player', 'Api\PlayerController');
	Route::resource('pennants/team', 'Api\TeamController');
});

Route::get('/', array('as' => 'home', function () {
	return View::make('singlepage');
}));

Route::post('/auth/login', array('before' => 'csrf_json', 'uses' => 'AuthController@login'));
Route::get('/auth/logout', 'AuthController@logout');
Route::get('/auth/status', 'AuthController@status');
Route::get('/auth/secrets','AuthController@secrets');