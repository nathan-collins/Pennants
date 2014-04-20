<!DOCTYPE html>
<html ng-app="pennantsApp">
<head>
	<title>@yield('title')</title>
	{{ HTML::style('/assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('/assets/styles/backend/font-awesome.css') }}
	{{ HTML::style('/assets/styles/backend/core.css') }}
	@section('header_scripts')
	@show
</head>
<body>
	<div class="row row-offcanvas-left">
		<!-- check for flash notification message -->
		@if(Session::has('flash_notice'))
			<div class="col-xs-12" id="flash" class="alert alert-notice">{{ Session::get('flash_notice') }}</div>
		@endif
		@yield('content')
	</div>
	@include('partials.scripts.userscripts')
	{{ HTML::script('assets/scripts/backend/min/core.js') }}
	{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
	{{ HTML::script('vendor/angular-sanitize/angular-sanitize.min.js') }}
	{{ HTML::script('scripts/app.js') }}
	@section('templates')
	@show
	@section('footer_scripts')
	@show
</body>
</html>