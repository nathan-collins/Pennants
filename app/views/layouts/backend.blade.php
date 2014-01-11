<!DOCTYPE html>
<html ng-app>
<head>
	<title>Laravel Authentication Demo</title>
	{{ HTML::style('assets/styles/frontend/bootstrap.css') }}
	{{ HTML::style('assets/styles/frontend/font-awesome.css') }}
	{{ HTML::style('assets/styles/frontend/core.css') }}
	@section('header_scripts')
	@show
</head>
<body>
@include('partials.backend.header')
@include('partials.backend.navigation')
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<!-- check for flash notification message -->
			@if(Session::has('flash_notice'))
				<div class="col-md-12" id="flash_notice">{{ Session::get('flash_notice') }}</div>
			@endif
			@yield('content')
		</div>
	</div><!-- end container -->
	@section('footer_scripts')
	{{ HTML::script('assets/scripts/frontend/core.js') }}
	@show
</body>
</html>