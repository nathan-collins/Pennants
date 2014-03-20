<div class="col-xs-12 col-md-12 col-lg-12 outer content-container">
	<a class="btn btn-default pull-right"  ng-href="/dashboard/pennants/game/add" role="button">Add Game</a>
	<h1>Select a game</h1>
	<section ng-controller="GameController">
		<div class="list-group">
			<table class="table">
				<tr ng-repeat="game in games">
					<td><% game.game_date %></td>
					<td club_id="<% game.host_id %>" club-text></td>
					<td width="60px">
						<a ng-href="/dashboard/pennants/match/<% game.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="glyphicon glyphicon-th-list"> Matches <span class="badge"></span></span>
							</button>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</section>
</div>
