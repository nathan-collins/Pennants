@extends('layouts.master')

@section('header_scripts')
{{ HTML::style('/assets/styles/frontend/blog/blog.css') }}
@stop

@section('heading_content')
Sunshine Coast Golf
<small>Latest news and information</small>
@stop

@section('content')
	<div class="row">
		@include('laravel-blog::partials.list')
		@include('laravel-blog::partials.archives')
	</div>
@stop