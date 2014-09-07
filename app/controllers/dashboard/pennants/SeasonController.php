<?php namespace dashboard\pennants;

use Mj\Breadcrumb\Breadcrumb;

class SeasonController extends \BaseController {

	public function __construct()
	{
		$this->breadcrumb = new Breadcrumb();
	}

	public function showSeason() {
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Season', '/season');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.season.season', $data);
	}

	public function addSeason() {
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Add Season', '/season/add');

		$this->breadcrumb->setSeparator(null);

		\JavaScript::put([
			'competition_id' => \Config::get('pennants.competition_id')
		]);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.season.create', $data);
	}
}