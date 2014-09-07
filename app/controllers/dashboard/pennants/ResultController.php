<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Pennants\Match\MatchRepositoryInterface;
use Mj\Breadcrumb\Breadcrumb;

class ResultController extends \BaseController {

	public function __construct(MatchRepositoryInterface $match)
	{
		$this->match = $match;
		$this->breadcrumb = new Breadcrumb();
	}

	/**
	 *
	 */
	public function showResults($matchId)
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Results', '/dashboard/pennants/results/'.$matchId);

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		$match = $this->match->find($matchId);

		JavaScript::put(array(
			'matchId' => $matchId,
			'clubId' => $match->club_id,
			'opponentId' => $match->opponent_id
		));

		return \View::make('pennants.result.result', $data)->with('matchId', $matchId)->with('clubId', $match->club_id)->with('opponentId', $match->opponent_id);
	}
}