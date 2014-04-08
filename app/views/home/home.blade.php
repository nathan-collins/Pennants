@extends('layouts.master')

@section('content')
	<div class="col-xs-12">
		<h1>Home page</h1>
    <p>Current time: {{ date('F j, Y, g:i A') }}  </p>
		<hr />
	</div>
	<div class="row">
		<div class="col-sm-8">

		</div>
		@include('partials.frontend.sidebar')
	</div>
@stop