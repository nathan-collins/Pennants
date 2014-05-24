@extends('layouts.backend')

@section('title')
Pennants Draws
@stop

@section('header_scripts')
{{ HTML::style('assets/styles/backend/draws/draws.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
{{ HTML::script('scripts/controllers/pennants/DrawController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
@stop

@section('content')
<section ng-controller="DrawController">
	<div class="col-md-6 content-container">
		<div class="well well-lg">
			<div season-display></div>
			<div grade-display></div>
		</div>
		<div class="widget">
			<div class="widget-header">
				<h3>Draws</h3>
			</div>
			<div class="widget-content">
				<div class="row">
					<tabset>
						<tab heading="Draw">@include('pennants.tabs.game.game')</tab>
						<tab heading="Clubs">@include('pennants.tabs.club.club')</tab>
					</tabset>
				</div>
			</div>
		</div>
	</div>
	@include('pennants.club.display')
</section>
@stop
