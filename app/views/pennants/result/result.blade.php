@extends('layouts.backend')

@section('title')
Pennants Results
@stop

@section('header_scripts')
{{ HTML::style('assets/styles/backend/results/results.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/ResultController.js') }}
{{ HTML::script('scripts/services/pennants/ResultService.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('scripts/directives/playerDirective.js') }}
@stop

@section('content')
<section ng-controller="ResultController">
	<div class="col-md-8 content-container">
		<div class="well well-lg">
			<div season-display></div>
			<div grade-display></div>
		</div>
		<h3>Results for <span club_id="<?php echo $clubId?>" club-text></span> VS <span club_id="<?php echo $opponentId?>" club-text></span></h3>
		<div class="widget" style="margin-top: 10px">
			<div class="widget-header">

			</div>
			<div class="widget-content">
				<table class="table-condensed message-table" width="100%">
					<tr>
						<th colspan="2" club_id="<?php echo $clubId?>" club-text></th>
						<th></th>
						<th colspan="2" club_id="<?php echo $opponentId?>" club-text></th>
					</tr>
					<tr ng-repeat="result in results">
						<td width="100px">
						  @include('pennants.result.result_dropdown', array('results' => $results, 'clubId' => $clubId))
						</td>
						<td player_id="<% result.player_id %>" player-match-club-text></td>
						<td>
							<button type="button" class="btn btn-default btn-sm pull-right">
								<span><% result.position %></span>
							</button>
						</td>
						<td>VS</td>
						<td player_id="<% result.versus_id %>" player-match-opponent-text></td>
						<td>
							<button type="button" class="btn btn-default btn-sm pull-right">
								<span><% result.position %></span>
							</button>
						</td>
						<td width="100px">
							@include('pennants.result.result_dropdown', array('results' => $results, 'clubId' => $clubId))
						</td>
					</tr>
					<p ng-show="!results.length">No matches found for this game</p>
				</table>
			</div>
		</div>
	</div>
	@include('pennants.result.display')
</section>
@stop