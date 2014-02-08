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
	Route::get('pennants/club/season/{seasonId}/{gradeId}', 'Api\ClubController@getClubBySeason');
	Route::resource('pennants/game', 'Api\GameController');
	Route::get('pennants/game/season/{seasonId}/{gradeId}', 'Api\GameController@getGameBySeason');
	Route::resource('pennants/result', 'Api\ResultController');
	Route::resource('pennants/player_result', 'Api\PlayerResultController');
	Route::resource('pennants/user', 'Api\UserController');
	Route::resource('pennants/player', 'Api\PlayerController');
	Route::resource('pennants/team', 'Api\TeamController');
});

Route::post('auth/login', array('before' => 'csrf_json', 'uses' => 'AuthController@login'));
Route::get('auth/logout', 'AuthController@logout');
Route::get('auth/status', 'AuthController@status');
Route::get('auth/secrets','AuthController@secrets');

Route::get('/', function() {
	return View::make('singlepage');
});

Route::any('{path?}', function ($path) {
	return View::make('singlepage');
});