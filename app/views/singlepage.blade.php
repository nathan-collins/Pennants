@extends('layouts.backend')

@section('footer_scripts')
{{ HTML::script('assets/scripts/backend/season.js') }}
@stop

@section('content')
<div ng-view></div>
@stop

@section('templates')

@stop