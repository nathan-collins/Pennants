@extends('layouts.master')

@section('header_scripts')
{{ HTML::style('/assets/styles/frontend/blog/blog.css') }}
@stop

@section('content')
	<div class="col-xs-12">
		<h3>
			Sunshine Coast Golf
			<small>Latest news and information</small>
		</h3>
		<hr />
	</div>
	<div class="row">
		@include('laravel-blog::partials.list')
		@include('laravel-blog::partials.archives')
	</div>
@stop