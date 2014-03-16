@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/SeasonController.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <section ng-controller="SeasonController">
    <a class="btn btn-default"  ng-href="season/add" role="button">Add Season</a>
    <h1>Select a season</h1>
    <div ng-repeat="(year, seasons) in groups">
      <h4><% year %></h4>
      <div class="list-group">
        <a ng-href="grade" class="list-group-item season-list" ng-click="storeSeason(season.id)" ng-repeat="season in seasons">
          <h4><% season.year %></h4>
          <p><% season.name %></p>
        </a>
      </div>
    </div>
  </section>
</div>
<div id="sidebar" role="navigation" class="col-md-2 col-lg-2">

</div>
@stop