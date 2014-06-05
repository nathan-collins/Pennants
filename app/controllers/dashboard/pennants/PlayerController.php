<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Pennants\Player\PlayerRepositoryInterface;

class PlayerController extends \BaseController {

	public function __construct(PlayerRepositoryInterface $player)
	{
		$this->player = $player;
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
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Players', '/dashboard/pennants/player/add');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
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
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Player', '/dashboard/pennants/player/');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		$player = $this->player->find($playerId);

		return \View::make('pennants.player.player', $data)->with('player', $player);
	}
}