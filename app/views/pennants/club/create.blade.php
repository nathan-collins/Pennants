@extends('layouts.backend')

@section('title')
Add Pennants Club
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/ClubController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
    <div grade-display></div>
  </div>
  <section ng-controller="AddClubController">
    <div class="widget">
			<div class="widget-header">
				<h3>Create a club</h3>
			</div>
			<div class="widget-content">
				<form name="AddClubForm" id="add-club-form" ng-submit="addClub(club, AddClubForm.$valid)" class="form-horizontal" role="form" novalidate>
					<div class="spinner" ng-show="loading">loading</div>
					<div class="form-group" ng-class="{ 'has-error' : AddClubForm.name.$invalid && !AddClubForm.name.$pristine }">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="name" ng-model="club.name" class="form-control" id="grade-input-name" placeholder="Name" required>
							<p ng-show="AddClubForm.name.$invalid && !AddClubForm.$pristine">Club name is required.</p>
						</div>
					</div>
					<div class="form-group" ng-class="{ 'has-error' : AddClubForm.state.$invalid && !AddClubForm.state.$pristine }">
						<label for="name" class="col-sm-2 control-label">State</label>
						<div class="col-sm-10">
							<select ng-model="club.state" class="form-control" required>
								<option value="VIC">Victoria</option>
								<option value="NSW">New South Wales</option>
								<option value="QLD">Queensland</option>
								<option value="SA">South Australia</option>
								<option value="WA">Western Australia</option>
								<option value="NT">Northern Territory</option>
								<option value="TAS">Tasmania</option>
							</select>
							<p ng-show="AddClubForm.state.$invalid && !AddClubForm.$pristine">State is required</p>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" ng-disabled="AddClubForm.$invalid || isUnchanged(club)">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
  </section>
</div>
@stop