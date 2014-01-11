@extends('layouts.layout')

@section('content')
	<div class="col-md-9 col-sm-9">
		<h1>Home page</h1>
    <p>Current time: {{ date('F j, Y, g:i A') }}  </p>
	</div>
	@include('partials.frontend.sidebar')
@stop