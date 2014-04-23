@extends('layouts.backend')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GameController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
{{ HTML::script('scripts/directives/bootstrap/positionDirective.js') }}
{{ HTML::script('scripts/directives/bootstrap/datePickerDirective.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
    <div grade-display></div>
  </div>
	<section ng-controller="AddGameController">
    <div class="widget">
			<div class="widget-header">
			<h3>Add a new games</h3>
			</div>
			<div class="widget-content">
			<form name="AddGameForm" id="add-game-form" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="host_id" class="col-sm-2 control-label">Game Date</label>
					<div class="col-sm-10">
						<p class="input-group">
							<input type="text" class="form-control" datepicker-popup="<% format %>" id="game-input-game-data" ng-model="game.game_date" is-open="opened" min="minDate" max="'maxDate'" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Close" />
							<span class="input-group-btn">
								<button class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
							</span>
						</p>
					</div>
				</div>
				<div class="form-group">
					<label for="host_id" class="col-sm-2 control-label">Host Club</label>
					<div class="col-sm-10">
						<clubselect id="select-game-host" ng-model="game.host" class="form-control"></clubselect>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default" ng-disabled="AddGameForm.$invalid || isUnchanged(club)" ng-click="addGame(game)">Submit</button>
					</div>
				</div>
			</form>
			</div>
		</div>
  </section>
</div>
@stop