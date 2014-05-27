<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Pennants\Match\MatchRepositoryInterface;

class ResultController extends \BaseController {

	public function __construct(MatchRepositoryInterface $match)
	{
		$this->match = $match;
	}

	/**
	 *
	 */
	public function showResults($matchId)
	{
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants');
		\Breadcrumb::addBreadcrumb('Season', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Grade', '/dashboard/pennants/grade');
		\Breadcrumb::addBreadcrumb('Results', '/dashboard/pennants/results/'.$matchId);

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		$match = $this->match->find($matchId);

		JavaScript::put([
			'matchId' => $matchId,
			'clubId' => $match->club_id,
			'opponentId' => $match->opponent_id
		]);

		return \View::make('pennants.result.result', $data)->with('matchId', $matchId)->with('clubId', $match->club_id)->with('opponentId', $match->opponent_id);
	}
}