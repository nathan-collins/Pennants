@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/DrawController.js') }}
{{ HTML::script('scripts/controllers/pennants/GameController.js') }}
{{ HTML::script('scripts/controllers/pennants/ClubController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('scripts/directives/bootstrap/tabsDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container" ng-controller="DrawController">
  <div class="jumbotron">
    <div season-display></div>
    <div grade-display></div>
  </div>
  <tabset justified="true">
    <tab heading="Draw" template-url="/views/tabs/pennants/game/game.html"></tab>
    <tab heading="Clubs" template-url="/views/tabs/pennants/club/club.html"></tab>
  </tabset>
</div>
@stop
