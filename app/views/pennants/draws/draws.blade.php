@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
{{ HTML::script('scripts/controllers/pennants/DrawController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container" ng-controller="DrawController">
  <div class="jumbotron">
    <div season-display></div>
    <div grade-display></div>
  </div>
  <tabset justified="true">
    <tab heading="Draw">@include('pennants.tabs.game.game')</tab>
    <tab heading="Clubs">@include('pennants.tabs.club.club')</tab>
  </tabset>
</div>
@stop
