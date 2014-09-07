<?php namespace dashboard\pennants;

use Laracasts\Utilities\JavaScript\Facades\JavaScript;
use Mj\Breadcrumb\Breadcrumb;

class GradeController extends \BaseController {

	public function __construct()
	{
		$this->breadcrumb = new Breadcrumb();
	}

	public function showGrade()
	{
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/grade');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.grade.grade', $data);
	}

	public function addGrade()
	{
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Grade', '/grade');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		return \View::make('pennants.grade.create', $data);
	}

	public function editGrade($gradeId)
	{
		$this->breadcrumb = new Breadcrumb();
		$this->breadcrumb->addbreadcrumb('Dashboard', '/dashboard');
		$this->breadcrumb->addBreadcrumb('Pennants', '/dashboard/pennants');
		$this->breadcrumb->addBreadcrumb('Season', '/dashboard/pennants/season');
		$this->breadcrumb->addBreadcrumb('Edit Grade', '/grade');

		$this->breadcrumb->setSeparator(null);

		$data = array(
			'breadcrumbs' => $this->breadcrumb->generate() //Breadcrumbs UL is generated and stored in an array.
		);

		JavaScript::put([
			'gradeId' => $gradeId
		]);

		return \View::make('pennants.grade.edit', $data);
	}
}