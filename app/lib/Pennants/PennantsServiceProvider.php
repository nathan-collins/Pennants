<?php namespace Pennants;


use Illuminate\Support\ServiceProvider;

class PennantsServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Pennants\Season\SeasonRepositoryInterface',
			'Pennants\Season\DbSeasonRepository'
		);

		$this->app->bind(
			'Pennants\Grade\GradeRepositoryInterface',
			'Pennants\Grade\DbGradeRepository'
		);

		$this->app->bind(
			'Pennants\Game\GameRepositoryInterface',
			'Pennants\Game\DbGameRepository'
		);

		$this->app->bind(
			'Pennants\Club\ClubRepositoryInterface',
			'Pennants\Club\DbClubRepository'
		);

		$this->app->bind(
			'Pennants\Player\PlayerRepositoryInterface',
			'Pennants\Player\DbPlayerRepository'
		);

		$this->app->bind(
			'Pennants\PlayersResult\PlayerResultRepositoryInterface',
			'Pennants\PlayersResult\DbPlayerResultRepository'
		);

		$this->app->bind(
			'Pennants\Result\ResultRepositoryInterface',
			'Pennants\Result\DbResultRepository'
		);

		$this->app->bind(
			'Pennants\User\UserRepositoryInterface',
			'Pennants\User\DbUserRepository'
		);

		$this->app->bind(
			'Pennants\Team\TeamRepositoryInterface',
			'Pennants\Team\DbTeamRepository'
		);

		$this->app->bind(
			'Pennants\Club\ClubRepositoryInterface',
			'Pennants\Club\DbClubRepository'
		);

		$this->app->bind(
			'Pennants\Match\MatchRepositoryInterface',
			'Pennants\Match\DbMatchRepository'
		);

		$this->app->bind(
			'Pennants\Rating\RatingRepositoryInterface',
			'Pennants\Rating\DbRatingRepository'
		);

		$this->app->bind(
			'Pennants\Competition\CompetitionRepositoryInterface',
			'Pennants\Competition\DbCompetitionRepository'
		);
	}

}