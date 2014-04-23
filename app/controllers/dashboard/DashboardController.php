<?php namespace dashboard;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class DashboardController extends \BaseController
{
	public function showIndex() {
		\Breadcrumb::addbreadcrumb('dashboard', 'dashboard');

		$data = array(
			'breadcrumbs' => \Breadcrumb::generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('dashboard.index', $data);
	}
}
