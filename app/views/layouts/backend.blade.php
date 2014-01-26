<!DOCTYPE html>
<html>
<head>
	<title>Something</title>
	{{ HTML::style('/assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('/assets/styles/backend/font-awesome.css') }}
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
				<div class="col-md-12" id="flash">{{ Session::get('flash_notice') }}</div>
			@endif
			@yield('content')
		</div>
	</div><!-- end container -->
	{{ HTML::script('/assets/scripts/backend/min/core.js') }}
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