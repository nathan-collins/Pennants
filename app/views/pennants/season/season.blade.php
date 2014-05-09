@extends('layouts.backend')

@section('header_scripts')
{{ HTML::style('assets/styles/backend/season/season.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/SeasonController.js') }}
@stop

@section('title')
Pennants Seasons
@stop

@section('header_title')
<h2>Pennants Seasons</h2>
<em>A list of pennants seasons</em>
@stop

@section('content')
<div class="col-md-4 content-container">
  <section ng-controller="SeasonController">
		<div class="widget">
			<div class="widget-header">
				<h3>Select a season</h3>
				<div class="btn-group widget-header-toolbar">
					<a ng-href="/dashboard/pennants/season/add">
						<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
							<span>Add Season</span>
						</button>
					</a>
				</div>
			</div>
			<div class="widget-content">
				<div class="knowledge" ng-repeat="(year, seasons) in groups">
					<ul class="list-unstyled">
						<li ng-repeat="season in seasons">
							<i class="fa fa-th-list pull-left"></i>
							<a ng-href="grade" ng-click="storeSeason(season.season_id)"><% season.name %> (<% year %>) <span class="badge element-bg-color-green pull-right"><% season.totals %></span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
  </section>
</div>
<div id="sidebar" role="navigation" class="col-md-2 col-lg-2">

</div>
@stop