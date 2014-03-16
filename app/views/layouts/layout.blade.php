<!DOCTYPE html>
<html ng-app="pennantsApp">
<head>
	<title>A Title</title>
	{{ HTML::style('assets/styles/backend/core.css') }}
	{{ HTML::style('assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('assets/styles/backend/font-awesome.css') }}
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
	@include('partials.backend.footer')
</body>
</html>