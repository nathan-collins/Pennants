<?php namespace dashboard\pennants;

use Pennants\Grade\GradeRepositoryInterface;
use Mj\Breadcrumb\Breadcrumb;

class DrawController extends \BaseController {

	public function __construct(GradeRepositoryInterface $grade)
	{
		$this->grade = $grade;
		$this->breadcrumb = new Breadcrumb();
	}

	public function showDraw()
	{
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/dashboard/pennants/grade');
		$this->breadcrumb->addBreadcrumb('Draws', '/dashboard/pennants/draws');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.draws.draws', $data);
	}
}