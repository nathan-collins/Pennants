@extends('layouts.backend')

@section('title')
Add Season
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/SeasonController.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <section ng-controller="AddSeasonController">
    <form novalidate name="AddSeasonForm" id="add-season-form" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="competition.name" placeholder="Name" typeahead="competitions for competition in getCompetition($viewValue)" typeahead-loading="loadingCompetitions" typeahead-min-length="4">
					<i ng-show="loadingCompetitions" class="glyphicon glyphicon-refresh"></i>
				</div>
			</div>
			<div class="competition-display">
				<table class="table">
					<tr ng-show="competition.show">
						<th>Competition Name</th>
						<th width="40px">Action</th>
					</tr>
					<tr ng-repeat="competition in competitions">
						<td><% competition.name %></td>
						<td>
							<a ng-click="populateSettings(competition)">
								<button type="button" class="btn btn-default btn-sm">
									<span class="fa fa-hand-o-down" title="Results"></span>
								</button>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<fieldset>
				<legend>Season Information</legend>
				<div class="form-group" ng-show="player.show_name">
					<label for="handicap" class="col-sm-2 control-label">Player Name</label>
					<div class="col-sm-10 competition-name">
						<input ng-model="season.id" type="hidden" value="<% season.competitionId %>" /><% season.name %>
					</div>
				</div>
				<div class="form-group">
          <label for="year" class="col-sm-2 control-label">Year</label>
          <div class="col-sm-10">
            <input type="year" class="form-control" ng-model="season.year" id="season-input-year" placeholder="Year">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" ng-disabled="AddSeasonForm.$invalid || isUnchanged(season)" ng-click="addSeason(season)">Submit</button>
          </div>
        </div>
			</fieldset>
		</form>
  </section>
</div>
@stop