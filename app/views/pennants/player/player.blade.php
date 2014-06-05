@extends('layouts.backend')

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/PlayerController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <section ng-controller="PlayerController">
		<h1><?php echo $player->name?></h1>
  </section>
</div>
@stop