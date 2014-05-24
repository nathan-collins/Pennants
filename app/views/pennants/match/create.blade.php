@extends('layouts.backend')

@section('title')
Add Match
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/MatchController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
@stop

@section('content')
<div class="col-xs-6 col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
		<div grade-display></div>
  </div>
	<section ng-controller="AddMatchController">
		<div class="widget" style="margin-top: 10px">
			<div class="widget-header">
				<h3 club_id="<?php echo $hostId?>" club-text></h3>
			</div>
			<div class="widget-content">
				<form name="AddMatchForm" id="add-match-form" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="host_id" class="col-sm-2 control-label">Club</label>
						<div class="col-sm-10">
							<clubselect id="select-match-host" ng-model="match.game_id" class="form-control"></clubselect>
						</div>
					</div>
					<div class="form-group">
						<label for="host_id" class="col-sm-2 control-label">Versus</label>
						<div class="col-sm-10">
							<clubselect id="select-match-host" ng-model="match.opponent_id" class="form-control"></clubselect>
						</div>
					</div>
					<div class="form-group">
						<label for="host_id" class="col-sm-2 control-label">Tee time</label>
						<div class="col-sm-10">
							<timepicker ng-model="game_time" ng-change="changed()" hour-step="hstep" minute-step="mstep" show-meridian="ismeridian"></timepicker>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" ng-disabled="AddGameForm.$invalid || isUnchanged(club)" ng-click="addMatch(match)">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
  </section>
</div>
@stop