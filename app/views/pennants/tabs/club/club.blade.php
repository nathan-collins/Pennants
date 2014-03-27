<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
	<a class="btn btn-default pull-right"  ng-href="/dashboard/pennants/club/add" role="button">Add Club</a>
	<h1>Select a club</h1>
	<section data-ng-controller="ClubController">
		<div class="list-group">
			<table class="table">
				<tr ng-repeat="club in clubs">
					<td><a ng-href="/dashboard/pennants/club/<% club.id %>"><% club.name %></a></td>
					<td>
						<button type="button" class="btn btn-default btn-sm pull-right" ng-click="getRatings(club.id)">
							<span class="glyphicon glyphicon-th-list"></span>
						</button>
					</td>
				</tr>
			</table>
		</div>
	</section>
</div>