@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/ClubController.js') }}
{{ HTML::script('scripts/controllers/pennants/MatchController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('scripts/directives/bootstrap/tabsDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <section ng-controller="ClubController">
    <a class="btn btn-default"  ng-href="/pennants/club/add" role="button">Add Club</a>
    <h1>Select a club</h1>
    <div class="list-group">
      <a ng-href="dashboard/pennants/club/<% club.id %>" class="list-group-item" ng-repeat="club in clubs">
        <h4><% club.name %></h4>
      </a>
    </div>
  </section>
</div>
@stop