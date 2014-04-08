<!DOCTYPE html>
<html ng-app="pennantsApp">
<head>
	<title>A Title</title>
	{{ HTML::style('assets/styles/backend/core.css') }}
	{{ HTML::style('assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('assets/styles/backend/font-awesome.css') }}
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	@section('header_scripts')
	@show
</head>
<body>
<div class="row row-offcanvas row-offcanvas-left">
	<div class="col-xs-12 col-sm-12">
	@include('partials.backend.header')
	</div>
	<div id="sidebar" role="navigation" class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
	@include('partials.backend.navigation')
	</div>
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<!-- check for flash notification message -->
			@if(Session::has('flash_notice'))
				<div class="col-md-12" id="flash_notice">{{ Session::get('flash_notice') }}</div>
			@endif
			@yield('content')
		</div>
	</div><!-- end container -->
	@include('partials.backend.footer')
	@include('partials.scripts.userscripts')
	{{ HTML::script('assets/scripts/backend/min/core.js') }}
	@section('footer_scripts')
	@show
</div>
</body>
</html>