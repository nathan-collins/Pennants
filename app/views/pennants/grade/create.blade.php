@extends('layouts.backend')

@section('header_scripts')
{{ HTML::style('assets/styles/backend/grade/grade.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GradeController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
@stop

@section('title')
Pennants Grades
@stop

@section('header_title')
<h2>Pennants Grades</h2>
<em>Add a new pennants grade</em>
@stop

@section('content')
<div class="col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
  </div>
	<div header-display season="true"></div>
  <section ng-controller="AddGradeController">
    <div class="widget">
			<div class="widget-header">
				<h3>Create a grade</h3>
			</div>
			<div class="widget-content">
				<form name="AddGradeForm" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="name" class="form-control" id="grade-input-name" ng-model="grade.name" placeholder="Name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" ng-disabled="AddGradeForm.$invalid || isUnchanged(grade)" ng-click="addGrade(grade)">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
  </section>
</div>
@stop