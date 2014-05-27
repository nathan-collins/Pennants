@extends('layouts.backend')

@section('title')
Add a new player
@stop

@section('header_scripts')
{{ HTML::style('assets/styles/backend/player/player.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/PlayerController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
		<div grade-display></div>
  </div>
	<section ng-controller="AddPlayerController">
		<div class="widget">
			<div class="widget-header">
				<h3>Add a new player for <club-text club_id="<% clubId %>"></club-text></h3>
			</div>
			<div class="widget-content">
				<form novalidate name="AddPlayerForm" id="add-player-form" method="post" class="form-horizontal" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" ng-model="player.name" id="player-input-name" placeholder="Name">
							<i ng-show="loadingPlayers" class="glyphicon glyphicon-refresh"></i>
						</div>
					</div>
					<div class="player-display">
						<table class="table">
							<tr>
								<th>Player Name</th>
								<th>Year</th>
								<th>Club</th>
								<th>Golf Link Number</th>
								<th width="40px">Action</th>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td>
									<a ng-href="/dashboard/pennants/results/<% match.id %>">
										<button type="button" class="btn btn-default btn-sm">
											<span class="fa fa-hand-o-down" title="Results"><span class="badge"></span></span>
										</button>
									</a>
								</td>
							</tr>
						</table>
					</div>
				</form>
			</div>
		</div>

		<div class="widget">
			<div class="widget-header">
				<h3>Add a new player for <club-text club_id="<% clubId %>"></club-text></h3>
			</div>
			<div class="widget-content">
				<form novalidate name="AddPlayerForm" id="add-player-form" method="post" class="form-horizontal" role="form">
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
						  <div class="player-name">
								<club-text club_id="<% clubId %>"></club-text>
						  </div>
						</div>
					</div>
					<div class="input-group">
						<button type="submit" class="btn btn-default" ng-disabled="AddPlayerForm.$invalid || isUnchanged(player)" ng-click="addPlayer(player)">Submit</button>
					</div>
				</form>
			</div>
		</div>
  </section>
</div>
@stop