<section ng-controller="PlayerController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Players</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/player/add/<% clubId %>">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add Player</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr ng-repeat="player in players">
					<td width="100px"><% player.name %></td>
					<td width="60px">
						<a ng-href="dashboard/pennants/player/<% player.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-th-list"> Matches <span class="badge"></span></span>
							</button>
						</a>
					</td>
				</tr>
				<p ng-show="!matches.length">No players for this club</p>
			</table>
		</div>
	</div>
</section>
