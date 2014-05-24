@extends('layouts.backend')

@section('title')
Pennants Club Matches
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
	<section ng-controller="ClubMatchController">
		<div class="widget" style="margin-top: 10px">
			<div class="widget-header">
				<h3>
					Matches for <span club_id="<?php echo $clubId?>" club-text></span>
				</h3>
				<div class="btn-group widget-header-toolbar">
					<a ng-href="/dashboard/pennants/game/add">
						<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
							<span>Add A Match</span>
						</button>
					</a>
				</div>
			</div>
			<div class="widget-content">
				<table class="table-condensed message-table" width="100%">
					<tr>
						<th>Time</th>
						<th>Opponent</th>
						<th>Host</th>
					</tr>
					<tr ng-repeat="match in matches">
						<td width="100px"><% match.game_time %></td>
						<td club_id="<% match.versus %>" club-text></td>
						<td club_id="<% match.host_id %>" club-text></td>
						<td width="60px">
							<a ng-href="/dashboard/pennants/match/<% match.id %>">
								<button type="button" class="btn btn-default btn-sm">
									<span class="fa fa-list" title="Matches"></span>
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