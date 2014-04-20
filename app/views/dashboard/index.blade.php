@extends('layouts.backend')

@section('header_title')
<h2>DASHBOARD</h2>
<em>the first priority information</em>
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/dashboard/DashboardController.js') }}
@stop

@section('content')

@stop