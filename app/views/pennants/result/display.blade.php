<div class="col-md-4" id="display-info">
	<div class="well well-lg">
	  <section ng-controller="TeamController">
			<div class="widget" style="margin-top: 10px">
				<div class="widget-header">
					<h3><span club_id="<?php echo $clubId?>" club-text></span> Players</h3>
					<div class="btn-group widget-header-toolbar">
					<a ng-href="/dashboard/pennants/player/add/<?php echo $clubId ?>">
						<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
							<span>Add Player</span>
						</button>
					</a>
				</div>
				</div>
				<div class="widget-content">
					<table class="table-condensed message-table" width="100%">
						<tr ng-repeat="player in players">
							<td><% player.name %></td>
							<td><% player.handicap %></td>
							<td width="170px">
								<div class="btn-group btn-group-sm player-group" data-toggle="buttons-checkbox">
									<button type="button" ng-click="teamPlayer(player.id, 'Yes', <?php echo $clubId ?>)" ng-model="team.yes" class="btn btn-default">Yes</button>
									<button type="button" ng-click="teamPlayer(player.id, 'Res', <?php echo $clubId ?>)" ng-model="team.res" class="btn btn-default">Reserve</button>
									<button type="button" ng-click="teamPlayer(player.id, 'No', <?php echo $clubId ?>)" ng-model="team.no" class="btn btn-default">No</button>
								</div>
							</td>
						</tr>
						<p ng-show="!players.length">No players for this match</p>
					</table>
				</div>
			</div>
		</section>
	</div>
	<h1>VS</h1>
	<div class="well well-lg">
		<section ng-controller="OpponentController">
			<div class="widget" style="margin-top: 10px">
				<div class="widget-header">
					<h3><span club_id="<?php echo $opponentId?>" club-text></span> Players</h3>
					<div class="btn-group widget-header-toolbar">
					<a ng-href="/dashboard/pennants/player/add/<?php echo $opponentId ?>">
						<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
							<span>Add Player</span>
						</button>
					</a>
				</div>
				</div>
				<div class="widget-content">
					<table class="table-condensed message-table" width="100%">
						<tr ng-repeat="player in players">
							<td><% player.name %></td>
							<td><% player.handicap %></td>
							<td width="170px">
								<div class="btn-group btn-group-sm player-group" data-toggle="buttons-checkbox">
									<button type="button" ng-click="opponentPlayer(player.id, 'Yes', <?php echo $opponentId?>)" ng-model="opponent.yes" class="btn btn-default">Yes</button>
									<button type="button" ng-click="opponentPlayer(player.id, 'Res', <?php echo $opponentId?>)" ng-model="opponent.res" class="btn btn-default">Reserve</button>
									<button type="button" ng-click="opponentPlayer(player.id, 'No', <?php echo $opponentId?>)" ng-model="opponent.no" class="btn btn-default">No</button>
								</div>
							</td>
						</tr>
						<p ng-show="!players.length">No players for this match</p>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
