@extends('layouts.backend')

@section('header_scripts')
{{ HTML::style('assets/styles/backend/grade/grade.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GradeController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/filters/range.js') }}
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
  <section ng-controller="EditGradeController">
    <div class="widget">
			<div class="widget-header">
				<h3>Create a grade</h3>
			</div>
			<div class="widget-content">
				<form name="AddGradeForm" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="grade-input-name" ng-model="grade.name" placeholder="Name" ng-value="<% grade.name %>" />
						</div>
					</div>
					<fieldset style="margin-bottom:10px;">
						<legend>Grade Settings</legend>
						<div class="form-group">
							<label class="col-sm-10 control-label">What is the maximum number of players for each match?</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" ng-model="grade.settings.players" grade-settings-players />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-10 control-label">What is the maximum number of reserve players for each match?</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" placeholder="" ng-model="grade.settings.reserves" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-10 control-label">Is this a home and away season?</label>
							<div class="col-sm-2">
								<select class="form-control" ng-model="grade.settings.home_away">
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-10 control-label">How many matches are handicapped?</label>
							<div class="col-sm-2">
								<select class="form-control" ng-model="grade.settings.handicapped">
									<option class="matches-handicapped" value="all">All</option>
									<option class="matches-handicapped" value="some">Some</option>
									<option class="matches-handicapped" value="none">None</option>
								</select>
							</div>
						</div>
						<div class="handicapped-settings" ng-show="grade.settings.handicapped=='some'">
							<div class="form-group">
								<label class="col-sm-10 control-label">How many players are not handicapped?</label>
								<div class="col-sm-2">
									<select class="form-control" ng-model="grade.settings.not_handicapped" ng-options="obj for obj in maxPlayers" handicapped-players></select>
								</div>
							</div>
							<div ng-show="grade.settings.not_handicapped">
								<div class="form-group">
									<label class="col-sm-10 control-label">Which players are not handicapped?</label>
									<div class="col-sm-2">
										<label ng-repeat="num in maxPlayers" class="control-label not-handicapped">
											<input type="checkbox" checklist-model="grade.settings.not_handicapped_players" checklist-value="num" ng-disable="disabled" checklist-limit="grade.settings.not_handicapped_players" class="not-handicapped" /> <%num%>
										</label>
									</div>
								</div>
							</div>
						</div>
					</fieldset>
					<div class="form-group">
						<div class="col-sm-offset-10 col-sm-2">
							<button type="submit" class="btn btn-default" ng-disabled="EditGradeForm.$invalid || isUnchanged(grade)" ng-click="editGrade(grade)">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
  </section>
</div>
@stop