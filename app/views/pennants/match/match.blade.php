@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/MatchController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <div class="jumbotron">
    <div season-display></div>
		<div grade-display></div>
  </div>
	<section ng-controller="MatchController">
    <a class="btn btn-default"  ng-href="/dashboard/pennants/match/add/<% hostId %>" role="button">Add A Match</a>
    <h1>Select a match</h1>
    <div class="list-group">
      <a ng-href="/dashboard/pennants/match/<% match.id %>" class="list-group-item" ng-repeat="match in matches">
        <h4><% match.name %></h4>
      </a>
      <p ng-show="!matches.length">No matches for this club</p>
    </div>
  </section>
</div>
@stop