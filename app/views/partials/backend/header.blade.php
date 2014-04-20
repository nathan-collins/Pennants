<div class="container">
	<div class="row">
		<!-- logo -->
		<div class="col-md-2 logo">
			<a href="index.html">
				<img src="assets/img/kingboard-logo-white.png" alt="Kingboard - Admin Dashboard">
			</a>
			<h1 class="sr-only">Sunshine Coast Golf</h1>
		</div>
		<!-- end logo -->
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-3">
					<!-- search box -->
					<div id="tour-searchbox" class="input-group searchbox">
						<input type="search" class="form-control" placeholder="enter keyword here...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
					<!-- end search box -->
				</div>
				<div class="col-md-9">
					<div class="top-bar-right">
						<!-- responsive menu bar icon -->
						<a href="#" class="hidden-md hidden-lg main-nav-toggle"><i class="fa fa-bars"></i></a>
						<!-- end responsive menu bar icon -->
						<div class="notifications">
							<ul>
								<!-- notification: general -->
								<li class="notification-item general dropdown" ng-controller="DropdownController">
									<div class="btn-group">
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-bell"></i>
											<span class="count">8</span>
											<span class="circle"></span>
										</a>
										<ul class="dropdown-menu hidden" role="menu">
											<li class="notification-header">
												<em>You have 8 notifications</em>
											</li>
											<li ng-repeat="notification in notifications">
												<a href="#">
													<i class="fa fa-comment green-font"></i>
													<span class="text"><% notification.title %></span>
													<span class="timestamp"><% notification.time_lapse %></span>
												</a>
											</li>
											<li class="notification-footer">
												<a href="#">View All Notifications</a>
											</li>
										</ul>
									</div>
								</li>
								<!-- end notification: general -->
							</ul>
						</div>

						<!-- logged user and the menu -->
						<div class="logged-user dropdown" ng-contoller="DropdownController">
							<div class="btn-group">
								<a href="#" class="btn btn-link dropdown-toggle">
									<img src="assets/img/user-avatar.png">
									<span class="name">System</span>
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li ng-repeat="user in users">
										<a href="#">
											<i class="fa <% user.icon %>"></i>
											<span class="text"><% user.name %></span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- end logged user and the menu -->
					</div>
					<!-- /top-bar-right -->
				</div>
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /row -->
</div>