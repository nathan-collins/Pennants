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
<div class="col-md-6 content-container">
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
							<td>
								<a ng-href="/dashboard/pennants/draws"  ng-click="storeGrade(grade.id)">
									<% grade.name %>
								</a>
							</td>
							<td style="width:40px">
								<a ng-href="/dashboard/pennants/grade/<% grade.id %>/edit" class="inline pull-right">
									<button type="button" class="btn btn-default btn-sm">
										<span class="fa fa-pencil-square-o" title="Remove"><span class="badge"></span></span>
									</button>
								</a>
							</td>
							<td style="width:40px">
								<a ng-href="/dashboard/pennants/grade/<% grade.id %>/delete" class="inline pull-right">
									<button type="button" class="btn btn-default btn-sm">
										<span class="fa fa-trash-o" title="Remove"><span class="badge"></span></span>
									</button>
								</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
  </section>
</div>
@stop