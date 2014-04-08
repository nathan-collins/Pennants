@extends('layouts.login')

@section('title')
Login
@stop

@section('header_scripts')
{{ HTML::style('/assets/styles/backend/login/login.css') }}
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/auth/LoginController.js') }}
@stop

@section('content')
<section ng-controller="LoginController" id="content">
	<div class="page-signin">
		<div class="container">
			<div class="form-container">
				<div class="col-md-4 col-sm-12  col-md-offset-4">
					<!-- check for login error flash var -->
					@if (Session::has('flash_error'))
						<alert type="danger" close="">{{ Session::get('flash_error') }}</alert>
					@endif
					<?php echo Form::open(array('url' => '#', 'method' => 'POST', "class" => "form-horizontal")) ?>
					<fieldset>
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</span>
								<?php echo Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username', 'ng-model' => 'credentials.username', 'ng-class' => '')) ?>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-lock"></span>
								</span>
								<?php echo Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'ng-model' => 'credentials.password')) ?>
							</div>
						</div>
						<!-- submit button -->
						<footer>
							<div class="form-group">
								<span><?php echo Form::checkbox('rememberme', '1', array('class' => 'login-checkbox')) ?></span>
								<label>Keep me signed in</label>
								<button type="button" class="btn btn-primary pull-right" ng-click="submit()">Login</button>
							</div>
						</footer>
						<?php echo Form::close() ?>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</section>
@stop