@extends('layouts.backend')

@section('title')
Pennants Matches
@stop

@section('header_scripts')
{{ HTML::style('assets/styles/backend/player/player.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/MatchController.js') }}
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
	<section ng-controller="MatchHostController">
    <div class="widget" style="margin-top: 10px">
			<div class="widget-header">
			<h3>Select a match</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/match/add/<?php echo $hostId?>">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add Match</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<div class="list-group">
				<table class="table">
				<tr ng-repeat="match in matches">
					<td width="100px"><% match.game_time %></td>
					<td club_id="<% match.club_id %>" club-text></td>
					<td>VS</td>
					<td club_id="<% match.opponent_id %>" club-text></td>
					<td width="60px">
						<a ng-href="/dashboard/pennants/results/<% match.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="fa fa-flag-checkered" title="Results"><span class="badge"></span></span>
							</button>
						</a>
					</td>
				</tr>
				<p ng-show="!matches.length">No matches for this club</p>
				</table>
			</div>
		</div>
  </section>
</div>
@stop