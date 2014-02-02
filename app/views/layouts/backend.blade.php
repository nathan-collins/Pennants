<!DOCTYPE html>
<html>
<head>
	<title>Something</title>
	{{ HTML::style('/assets/styles/backend/bootstrap.css') }}
	{{ HTML::style('/assets/styles/backend/font-awesome.css') }}
	{{ HTML::style('/assets/styles/backend/core.css') }}
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
		<!-- check for flash notification message -->
		@if(Session::has('flash_notice'))
			<div class="col-xs-12" id="flash">{{ Session::get('flash_notice') }}</div>
		@endif
		@yield('content')
	</div>
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