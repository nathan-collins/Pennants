<?php namespace dashboard\pennants;

class SeasonController extends \BaseController {

	public function showSeason() {
		\Breadcrumb::addbreadcrumb('Dashboard', '/dashboard');
		\Breadcrumb::addBreadcrumb('Pennants', '/dashboard/pennants/season');
		\Breadcrumb::addBreadcrumb('Season', '/season');

		\Breadcrumb::setSeperator(null);

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.season.season', $data);
	}

	public function addSeason() {
		\JavaScript::put([
			'competition_id' => \Config::get('pennants.competition_id')
		]);

		return \View::make('pennants.season.create');
	}
}