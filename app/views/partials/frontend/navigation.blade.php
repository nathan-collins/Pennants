<div class="navbar navbar-fixed-top navbar-default" role="navigation">
	<ul class="nav navbar-nav">
		<li><?php echo link_to_route('home', 'Home') ?></li>
		@if(Auth::check())
				<li><?php echo link_to_route('profile', 'Profile' ) ?></li>
				<li><?php echo link_to_route('logout', 'Logout ('.Auth::user()->username.')') ?></li>
		@else
				<li><?php echo link_to_route('login', 'Login') ?></li>
		@endif
	</ul>
</div><!-- end nav -->