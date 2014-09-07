<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Pennants\Player\PlayerRepositoryInterface;
use Mj\Breadcrumb\Breadcrumb;

class PlayerController extends \BaseController {

	public function __construct(PlayerRepositoryInterface $player, PlayerRepositoryInterface $player_season)
	{
		$this->player = $player;
		$this->player_season = $player_season;
		$this->breadcrumb = new Breadcrumb();
	}

	public function showPlayersByClub($clubId) {
		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.club.container');
	}

	/**
	 * @param $clubId
	 * @return mixed
	 */
	public function addPlayer($clubId) {
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Players', '/dashboard/pennants/player/add');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'clubId' => $clubId
		]);

		return \View::make('pennants.player.create', $data);
	}

	/**
	 * @param $playerId
	 * @param $seasonId
	 * @param $gradeId
	 */
	public function showPlayer($playerId, $seasonId, $gradeId)
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Player', '/dashboard/pennants/player/');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		$player = $this->player->find($playerId);
		$playerSeasons = $this->player_season->getPlayerById($playerId)->get();

		return \View::make('pennants.player.player', $data)->with('player', $player)->with('player_seasons', $playerSeasons);
	}
}