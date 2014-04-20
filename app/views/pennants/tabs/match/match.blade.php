<section ng-controller="MatchController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Matches</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/game/add">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add A Match</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr ng-repeat="match in matches">
					<td width="100px"><% match.name %></td>
					<td club_id="<% game.host_id %>" club-text></td>
					<td width="60px">
						<a ng-href="/dashboard/pennants/match/<% match.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-th-list"> Matches <span class="badge"></span></span>
							</button>
						</a>
					</td>
				</tr>
				<p ng-show="!matches.length">No matches for this club</p>
			</table>
		</div>
	</div>
</section>