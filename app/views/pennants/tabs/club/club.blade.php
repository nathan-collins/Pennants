<section data-ng-controller="ClubController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Clubs</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/club/add">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add Club</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr ng-repeat="club in clubs">
					<td class="club-action"><% club.name %></td>
					<td width="40px">
						<button type="button" class="btn btn-default btn-sm pull-right" title="Ratings" ng-click="getRatings(club.id, club.name)">
							<span class="glyphicon glyphicon-signal"></span>
						</button>
					</td>
					<td width="40px">
						<a ng-href="/dashboard/pennants/club/players/<% club.id %>">
							<button type="button" class="btn btn-default btn-sm pull-right" title="Players">
								<span class="fa fa-users"></span>
							</button>
						</a>
					</td>
					<td width="40px">
						<a ng-href="/dashboard/pennants/club/matches/<% club.id %>">
							<button type="button" class="btn btn-default btn-sm pull-right" title="Matches">
								<span class="fa fa-list"></span>
							</button>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>