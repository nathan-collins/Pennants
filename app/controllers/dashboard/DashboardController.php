<?php namespace dashboard;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;

class DashboardController extends \BaseController
{
	public function showIndex() {
		return \View::make('dashboard.index');
	}
}
