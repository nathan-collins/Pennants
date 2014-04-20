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
					<td><a ng-href="/dashboard/pennants/club/<% club.id %>"><% club.name %></a></td>
					<td>
						<button type="button" class="btn btn-default btn-sm pull-right"  ng-click="launch(club.id)">
							<span class="glyphicon glyphicon-th-list"></span>
						</button>
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>