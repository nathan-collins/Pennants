<!DOCTYPE html>
<html ng-app="pennantsApp">
<head>
	<title>A Title</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	{{ HTML::style('assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('assets/styles/backend/font-awesome.css') }}
	{{ HTML::style('assets/styles/backend/core.css') }}
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	@section('header_scripts')
	@show
</head>
<body class="body-green">
@include('partials.frontend.navigation')
<div class="wrapper"> <!-- wrapper -->
	<div class="container">
		<div class="row">
			<!-- check for flash notification message -->
			@if(Session::has('flash_notice'))
				<div class="col-md-12" id="flash_notice">{{ Session::get('flash_notice') }}</div>
			@endif
			@yield('content')
		</div>
	</div>
	@include('partials.backend.footer')
	@include('partials.scripts.userscripts')
	{{ HTML::script('assets/scripts/backend/min/core.js') }}
	@section('footer_scripts')
	@show
</div>
</body>
</html>