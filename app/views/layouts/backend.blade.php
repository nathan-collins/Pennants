<!DOCTYPE html>
<html ng-app="scg">
<head>
	<title>A Layout</title>
	{{ HTML::style('assets/styles/backend/core.css') }}
	@section('header_scripts')
	@show
</head>
<body ng-controller="PageContainer">
@include('partials.backend.header')
@include('partials.backend.navigation')
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<!-- check for flash notification message -->
			@if(Session::has('flash'))
				<div class="col-md-12" id="flash">{{ Session::get('flash_notice') }}</div>
			@endif
			@yield('content')
		</div>
	</div><!-- end container -->
	{{ HTML::script('assets/scripts/backend/core.js') }}
	<script>
    angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
  </script>
	@section('templates')
	@show
	@section('footer_scripts')
	@show
</body>
</html>