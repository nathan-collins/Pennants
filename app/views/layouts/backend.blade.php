<!DOCTYPE html>
<html ng-app="pennantsApp">
<head>
	<title>
		@section('title')
		@show
	</title>
	{{ HTML::style('assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('assets/styles/backend/font-awesome.css') }}
	{{ HTML::style('assets/styles/backend/core.css') }}
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	@section('header_scripts')
	@show
</head>
<body class="dashboard">
	<div class="wrapper">
		<div class="top-bar">
			@include('partials.backend.header')
		</div>
	</div>
	<div class="bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-2 left-sidebar">
					@include('partials.backend.navigation')
				</div>
				<div class="col-md-10 content-wrapper">
					<div class="row">
						<div class="col-md-4">
							@include('partials.backend.breadcrumb')
						</div>
						<div class="col-md-8">
							@include('partials.backend.stats')
						</div>
					</div>
					<div class="content">
						@include('partials.backend.main_header')
						<div class="main-content">
					 		@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
		@include('partials.backend.footer')
	</div>
	@include('partials.scripts.userscripts')
	{{ HTML::script('assets/scripts/backend/min/core.js') }}
	{{ HTML::script('assets/scripts/backend/min/ui-bootstrap-custom-tpls-0.10.0.min.js') }}
	{{ HTML::script('scripts/controllers/dashboard/DropdownController.js') }}
	@section('footer_scripts')
	@show
</body>
</html>