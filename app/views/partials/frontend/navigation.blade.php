<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand logo" href="index.html">Sunshine Coast Golf</a>
		</div>
		<div class="navbar-collapse collapse">
	 		<ul class="nav navbar-nav">
				<li><a href="/">Home</a></li>
				<li><a href="pennants">Pennants</a></li>
				<li><a href="links">Links</a></li>
	 		</ul>
			<ul class="nav navbar-nav navbar-right hidden-xs">
				<?php if(!Auth::check()):?>
				<li id="sign-in"><a href="/login">Sign In</a></li>
				<li id="sign-up"><a href="sign-in.html">Sign Up</a></li>
				<?php endif;?>
				<?php if(Auth::check()):?>
				<li class="show animated flipInX" id="user-bar">
					<span class="user-bar-avatar pull-right">
						{{HTML::image('assets/images/scg_logo.png')}}
					</span>
					<a href="#" class="pull-right"><?php echo Auth::user()->email?></a>
					<span class="pull-right user-bar-icons">
						<a href="/auth/logout"><i class="fa fa-sign-out" id="sign-out"></i></a>
						<a href="/auth/profile"><i class="fa fa-cog"></i></a>
					</span>
				</li>
				<?php endif;?>
				<!-- Search Button -->
				<li id="search">
				<a href="#" id="search-btn"><i class="fa fa-search" id="search-icon"></i> Search</a>
				<div class="search-box hidden" id="search-box">
					<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
					</div>
				</div>
				</li>
			</ul>
		</div>
	</div>
</div>