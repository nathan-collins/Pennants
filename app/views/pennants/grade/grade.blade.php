@extends('layouts.layout')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GradeController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
@stop

@section('content')
<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
  <div class="jumbotron">
    <div season-display></div>
  </div>
  <section ng-controller="GradeController">
    <a class="btn btn-default"  ng-href="/dashboard/pennants/grade/add" role="button">Add Grade</a>
    <h1>Select a grade</h1>
    <div class="list-group">
      <a ng-href="/dashboard/pennants/draws" class="list-group-item" ng-click="store(grade.id)" ng-repeat="grade in grades">
        <h4 class="" style="display:inline-block"><% grade.name %></h4>
        <button type="button" class="btn btn-default btn-sm pull-right">
          <span class="glyphicon glyphicon glyphicon-remove"></span>
        </button>
      </a>
    </div>
  </section>
</div>
@stop