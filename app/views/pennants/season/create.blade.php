@extends('layouts.backend')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/SeasonController.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <section ng-controller="AddSeasonController">
    <form novalidate name="AddSeasonForm" id="add-season-form" method="post" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="year" class="col-sm-2 control-label">Year</label>
          <div class="col-sm-10">
            <input type="year" class="form-control" ng-model="season.year" id="season-input-year" placeholder="Year">
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="name" class="form-control" ng-model="season.name" id="season-input-name" placeholder="Name">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default" ng-disabled="AddSeasonForm.$invalid || isUnchanged(season)" ng-click="addSeason(season)">Submit</button>
          </div>
        </div>
      </form>
  </section>
</div>
@stop