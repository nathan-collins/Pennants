@extends('layouts.backend')

@section('header_scripts')
{{ HTML::style('assets/styles/backend/grade/grade.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/GradeController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
@stop

@section('title')
Pennants Grades
@stop

@section('header_title')
<h2>Pennants Grades</h2>
<em>A list of pennants grades for season</em>
@stop

@section('content')
<div class="col-md-4 content-container">
  <div class="well well-lg knowledge-recent-popular">
    <div season-display></div>
  </div>
  <section ng-controller="GradeController">
    <div class="widget">
			<div class="widget-header">
				<h3>Select a grade</h3>
				<div class="btn-group widget-header-toolbar">
					<a ng-href="/dashboard/pennants/grade/add">
						<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
							<span>Add Grade</span>
						</button>
					</a>
				</div>
			</div>
			<div class="widget-content">
				<div class="grades">
					<table class="table-condensed message-table" width="100%">
						<tr ng-repeat="grade in grades">
							<td width="25px"><i class="fa fa-th-list pull-left inline"></i></td>
							<td><a ng-href="/dashboard/pennants/draws"  ng-click="storeGrade(grade.id)"><% grade.name %></a></td>
							<td><a ng-href="/dashboard/pennants/draws" class="inline pull-right"><span class="glyphicon glyphicon-remove"></span></a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
  </section>
</div>
@stop