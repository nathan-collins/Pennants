<?php

use Pennants\Season\SeasonRepositoryInterface;
use Pennants\Grade\GradeRepositoryInterface;
use Pennants\Player\PlayerRepositoryInterface;

class PennantsController extends BaseController
{
	public function __construct(SeasonRepositoryInterface $season, GradeRepositoryInterface $grade, PlayerRepositoryInterface $player)
	{
		$this->season = $season;
		$this->grade = $grade;
		$this->player = $player;
	}

	public function showIndex($alias = '', $year = null)
	{
		$seasons = $this->season->all();

		$alias = empty($alias) ? $seasons[0]->alias : $alias;
		$year = empty($year) ? $seasons[0]->year : $year;

		$season = $this->season->getSeasonId($alias, $year);

		JavaScript::put([
			'alias' => $alias,
			'year' => $year,
			'seasonId' => $season->seasonId
		]);

		return View::make('pennants.leaderboard.leaderboard')->with('seasons', $seasons);
	}

	public function showLeaderBoard($alias = '', $year = null, $grade = null) {
		$players = $this->player->getPlayerByGrade($alias, $year, $grade);

		JavaScript::put([
			'alias' => $alias,
			'year' => $year,
			'gradeId' => $grade
		]);

		return View::make('pennants.ladder.ladder')->with('players', $players);
	}
}