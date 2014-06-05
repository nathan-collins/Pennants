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

Route::post('auth/login', array('before' => 'csrf_json', 'uses' => 'api_v1\AuthController@login'));

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
	Route::get('auth/logout', 'api_v1\AuthController@logout');
	Route::get('auth/status', 'api_v1\AuthController@status');
	Route::get('auth/secrets','api_v1\AuthController@secrets');

	Route::resource('pennants/season', 'api_v1\SeasonController');
	Route::resource('pennants/grade', 'api_v1\GradeController');
	Route::get('pennants/grade/season/{seasonId}', 'api_v1\GradeController@getSeasons');
	Route::resource('pennants/club', 'api_v1\ClubController');
	Route::get('pennants/club/status/{status}/{clubId}', 'api_v1\ClubController@updateStatus');
	Route::get('pennants/club/season/{seasonId}/{gradeId}', 'api_v1\ClubController@getClubBySeason');
	Route::get('pennants/club/match/{seasonId}/{gradeId}/{matchId}', 'api_v1\ClubController@getClubByMatch');
	Route::get('pennants/club/host/{seasonId}/{gradeId}', 'api_v1\ClubController@getFilteredClub');
	Route::resource('pennants/game', 'api_v1\GameController');
	Route::get('pennants/game/season/{seasonId}/{gradeId}', 'api_v1\GameController@getGameBySeason');
	Route::resource('pennants/result', 'api_v1\ResultController');
	Route::get('pennants/result/match/{seasonId}/{gradeId}/{matchId}', 'api_v1\ResultController@getResultFromMatch');
	Route::resource('pennants/match', 'api_v1\MatchController');
	Route::get('pennants/match/club/{seasonId}/{gradeId}/{clubId}', 'api_v1\MatchController@getMatchFromClub');
	Route::get('pennants/match/host/{seasonId}/{gradeId}/{clubId}', 'api_v1\MatchController@getMatchFromHost');
	Route::resource('pennants/player_result', 'api_v1\PlayerResultController');
	Route::resource('pennants/user', 'api_v1\UserController');
	Route::resource('pennants/player', 'api_v1\PlayerController');
	Route::get('pennants/player/search/{name?}', 'api_v1\PlayerController@searchPlayer');
	Route::get('pennants/player/season/{seasonId}/{gradeId}/{clubId}', 'api_v1\PlayerController@getPlayerBySeason');
	Route::resource('pennants/team', 'api_v1\TeamController');
	Route::resource('pennants/rating', 'api_v1\RatingController');
	Route::get('pennants/rating/club/{clubId}', 'api_v1\RatingController@getRatingByClub');
	Route::get('pennants/rating/fetch/{courseId}', 'api_v1\RatingController@fetchRatings');
});

Route::group(array('prefix' => 'dashboard', 'before' => 'auth'), function()
{
	Route::get('/', 'dashboard\DashboardController@showIndex');

	Route::get('pennants/season', 'dashboard\pennants\SeasonController@showSeason');
	Route::get('pennants/season/add', 'dashboard\pennants\SeasonController@addSeason');

	Route::get('pennants/grade', 'dashboard\pennants\GradeController@showGrade');
	Route::get('pennants/grade/add', 'dashboard\pennants\GradeController@addGrade');

	Route::get('pennants/draws', 'dashboard\pennants\DrawController@showDraw');

	Route::get('pennants/club/add', 'dashboard\pennants\ClubController@addClub');
	Route::get('pennants/club/{clubId}', 'dashboard\pennants\ClubController@showClub');
	Route::get('pennants/club/players/{clubId}', 'dashboard\pennants\ClubController@showPlayers');
	Route::get('pennants/club/matches/{clubId}', 'dashboard\pennants\ClubController@showMatches');

	Route::get('pennants/game/add', 'dashboard\pennants\GameController@addGame');

	Route::get('pennants/player/{clubId}', 'dashboard\pennants\PlayerController@showPlayersByClub');
	Route::get('pennants/player/add/{clubId}', 'dashboard\pennants\PlayerController@addPlayer');
	Route::get('pennants/player/{playerId}/{seasonId}/{gradeId}', 'dashboard\pennants\PlayerController@showPlayer');

	Route::get('pennants/match/{matchId}', 'dashboard\pennants\MatchController@showMatch');
	Route::get('pennants/match/add/{hostId}', 'dashboard\pennants\MatchController@addMatch');

	Route::get('pennants/results/{resultId}', 'dashboard\pennants\ResultController@showResults');
});

Route::get('/', 'Fbf\LaravelBlog\PostsController@index');
Route::get('pennants', 'PennantsController@showIndex');
Route::get('pennants/{alias}/{seasonYear}', 'PennantsController@showIndex');
Route::get('pennants/players/{alias}/{seasonYear}/{gradeName}', 'PennantsController@showLeaderboard');
Route::get('links', 'LinksController@showIndex');
Route::get('login', 'AuthController@showLogin');
Route::get('user/profile', array('before' => 'auth', 'uses' => 'UserController@showProfile'));