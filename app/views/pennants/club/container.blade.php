@extends('layouts.backend')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/DrawController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('scripts/directives/bootstrap/tabsDirective.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <div class="well well-lg">
    <div season-display></div>
    <div grade-display></div>
  </div>
  <div class="widget">
		<div class="widget-header">
			<h3>Club</h3>
		</div>
		<div class="widget-content">
			<div class="row">
				<tabset>
					<tab heading="Draw">@include('pennants.tabs.match.match')</tab>
					<tab heading="Players">@include('pennants.tabs.player.player')</tab>
				</tabset>
			</div>
		</div>
	</div>
</div>
@stop