<section ng-controller="MatchClubController">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>
				Matches
				<?php if(!empty($club_id)):?>
				for <span club_id="<?php echo $clubId?>" club-text></span>
				<?php endif;?>
			</h3>
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
					<td width="100px"><% match.game_time %></td>
					<td club_id="<% match.opponent_id %>" club-text></td>
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