@extends('layouts.master')

@section('heading_content')
Sunshine Coast Golf
<small>Pennants Results</small>
@stop

@section('header_scripts')
{{ HTML::style('/assets/styles/frontend/pennants/pennants.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/LeaderBoardController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
@stop

@section('content')
<section ng-controller="LeaderBoardController">
	<div class="col-xs-2">
		<ul id="season-year" class="nav nav-pills nav-stacked">
		<?php foreach($seasons as $season) :?>
			<li class="<?php echo ($season->year == Request::segment(3)) ? "active" : "";?>"><?php echo link_to("pennants/$season->alias/$season->year", $season->year)?></li>
		<?php endforeach;?>
		</ul>
	</div>
	<div class="col-xs-10">
		<tabset class="grade-tabs">
			<tab ng-repeat="tab in tabs" heading="<% tab.title %>" gradeId="<% tab.gradeId %>">
				<div class="leaderboard-grade">
					<h3><% tab.title %> Leaderboard <span class="current-year"></span></h3>
					<p class="pull-right"><?php echo HTML::link("pennants/players/$season->alias/$season->year/<% tab.gradeId %>", "View Player Of The Year Results")?></p>
					<table class="table">
						<tr>
							<th class="leaderboard-rank">Rank</th>
							<th class="leaderboard-team">Team</th>
							<th class="leaderboard-points">Points</th>
							<th class="leaderboard-played">Played</th>
							<th class="leaderboard-wins">W</th>
							<th class="leaderboard-draws">D</th>
							<th class="leaderboard-losses">L</th>
							<th class="leaderboard-matches">Matches</th>
							<th class="leaderboard-diff">Diff</th>
						</tr>
						<tr ng-repeat="club in clubs">
							<td></td>
							<td><% club.name %></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</tab>
		</tabset>
	</div>
</section>
@stop