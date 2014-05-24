<section ng-controller="GameController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Games</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/dashboard/pennants/game/add">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Add Game</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr ng-repeat="game in games">
					<td width="100px"><% game.game_date %></td>
					<td club_id="<% game.host_id %>" club-text></td>
					<td width="60px">
						<a ng-href="/dashboard/pennants/match/<% game.host_id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="fa fa-list" title="Matches"><span class="badge"></span></span>
							</button>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>