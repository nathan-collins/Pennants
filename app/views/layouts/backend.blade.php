<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	{{ HTML::style('/vendor/bootstrap/dist/bootstrap.css') }}
	@section('header_scripts')
	@show
</head>
<body id="golf">
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
	{{ HTML::script('/vendor/angular/angular.js') }}
	{{ HTML::script('/vendor/angular-route/angular-route.js') }}
	{{ HTML::script('/vendor/angular-sanitize/angular-sanitize.js') }}
	{{ HTML::script('/vendor/underscore/underscore.js') }}
	<script type="text/javascript" src="/vendor/requirejs/require.js" data-main="/scripts/appBootstrap.js"></script>
	<script>
		define('global', function() {
			return <?php echo json_encode(array('CSRF_TOKEN' => csrf_token())); ?>
		});
  </script>
	@section('templates')
	@show
	@section('footer_scripts')
	@show
</body>
</html>