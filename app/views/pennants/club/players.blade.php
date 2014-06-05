@extends('layouts.backend')

@section('title')
Pennants Club Players
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/ClubController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
@stop

@section('content')
<div class="col-md-6 outer content-container">
  <div class="well well-lg">
    <div season-display></div>
    <div grade-display></div>
  </div>
	<section ng-controller="ClubPlayerController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Players for  <span club_id="<?php echo $clubId?>" club-text></span></h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/player/add/<% clubId %>">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add Player</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr ng-repeat="player in players">
					<td><% player.name %></td>
					<td><% player.golf_link_number %></td>
					<td width="60px"><% player.handicap %></td>
					<td width="40px">
						<a ng-href="/dashboard/pennants/player/<% player.id %>/<% seasonId %>/<% gradeId %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="fa fa-user" title="View Player Details"></span>
							</button>
						</a>
					</td>
				</tr>
				<p ng-show="!players.length">No players for this club</p>
			</table>
		</div>
	</div>
</section>
</div>
@stop