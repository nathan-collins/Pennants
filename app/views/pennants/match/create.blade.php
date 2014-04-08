@extends('layouts.backend')

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
	<section ng-controller="AddMatchController">

  </section>
</div>
@stop