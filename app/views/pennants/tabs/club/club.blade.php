<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
	<a class="btn btn-default pull-right"  ng-href="/dashboard/pennants/club/add" role="button">Add Club</a>
	<h1>Select a club</h1>
	<section ng-controller="ClubController">
		<div class="list-group">
			<a ng-href="/dashboard/pennants/club/<%club.id%>" class="list-group-item" ng-repeat="club in clubs">
				<h4 class="inline"><% club.name %></h4>
				<button type="button" class="btn btn-default btn-sm pull-right" ng-click="getRatings()">
					<span class="glyphicon glyphicon-th-list"></span>
				</button>
			</a>
		</div>
	</section>
</div>