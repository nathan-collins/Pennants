@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GameController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-0.10.0.min.js') }}
{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
{{ HTML::script('scripts/directives/positionDirective.js') }}
{{ HTML::script('scripts/directives/bootstrap/datePickerDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-6 col-lg-8 outer content-container">
  <section ng-controller="AddGameController">
    <h1>Add a new games</h1>
    <form name="AddGameForm" id="add-game-form" class="form-horizontal" role="form">
      <div class="form-group">
        <label for="host_id" class="col-sm-2 control-label">Game Date</label>
        <div class="col-sm-10">
          <p class="input-group">
            <input type="text" class="form-control" datepicker-popup="<% format %>" id="game-input-game-data" ng-model="game.game_date" is-open="opened" min="minDate" max="'maxDate'" datepicker-options="dateOptions" date-disabled="disabled(date, mode)" ng-required="true" close-text="Close" />
            <span class="input-group-btn">
              <button class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
            </span>
          </p>
        </div>
      </div>
      <div class="form-group">
        <label for="host_id" class="col-sm-2 control-label">Host Club</label>
        <div class="col-sm-10">
          <clubselect id="select-game-host" ng-model="game.host" class="form-control"></clubselect>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" ng-disabled="AddGameForm.$invalid || isUnchanged(club)" ng-click="addGame(game)">Submit</button>
        </div>
      </div>
    </form>
  </section>
</div>
@stop