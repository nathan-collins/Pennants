@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/PlayerController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <div class="jumbotron">
    <div season-display></div>
		<div grade-display></div>
  </div>
	<section ng-controller="AddPlayerController">
		<form novalidate name="AddPlayerForm" id="add-player-form" method="post" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<input type="text" ng-model="asyncSelected" class="form-control" ng-model="player.name" id="player-input-name" placeholder="Name" typeahead="address for address in getPlayer($playerValue) | filter:$playerValue" typeahead-loading="loadingPlayers">
					<i ng-show="loadingPlayers" class="glyphicon glyphicon-refresh"></i>
				</div>
			</div>
			<div class="form-group">
				<label for="handicap" class="col-sm-2 control-label">Handicap</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="player.handicap" id="player-input-handicap" placeholder="Handicap">
				</div>
			</div>
			<div class="form-group">
				<label for="golf_link_number" class="col-sm-2 control-label">Golf Link Number</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" ng-model="player.golf_link_number" id="player-input-golf_link_number" placeholder="Golf Link Number">
				</div>
			</div>
			<div class="form-group">
        <label for="host_id" class="col-sm-2 control-label">Club</label>
        <div class="col-sm-10">
         <club-text club_id="<% clubId %>"></club-text>
        </div>
      </div>
			<div class="form-group pull-right">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" ng-disabled="AddPlayerForm.$invalid || isUnchanged(player)" ng-click="addPlayer(player)">Submit</button>
        </div>
      </div>
		</form>
  </section>
</div>
@stop