<?php namespace dashboard\pennants;

class GradeController extends \BaseController {

	public function showGrade()
	{
		return \View::make('pennants.grade.grade');
	}
}