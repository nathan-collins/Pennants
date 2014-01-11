@extends('layouts.layout')

@section('content')
<div class="col-md-4 col-md-offset-4">
	<div class="well">
		<header>Login</header>

		<!-- check for login error flash var -->
		@if (Session::has('flash_error'))
						<div id="flash_error">{{ Session::get('flash_error') }}</div>
		@endif

		<?php echo Form::open(array('url' => 'login', 'method' => 'POST')) ?>

		<!-- username field -->
		<p>
				{{ Form::label('username', 'Username') }}<br/>
				{{ Form::text('username', Input::old('username')) }}
		</p>

<!-- password field -->
		<p>
				{{ Form::label('password', 'Password') }}<br/>
				{{ Form::password('password') }}
		</p>

<!-- submit button -->
		<footer>{{ Form::submit('Login') }}</footer>

		{{ Form::close() }}
	</div>
</div>
@stop