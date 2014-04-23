<section data-ng-controller="ClubRatings">
	<div class="widget" style="margin-top: 10px">
		<div class="widget-header">
			<h3>Ratings</h3>
			<div class="btn-group widget-header-toolbar">
				<a ng-href="/api/v1/pennants/rating/fetch/<?php echo $clubId ?>">
					<button type="button" class="btn btn-primary btn-sm btn-ajax"><i class="fa fa-floppy-o"></i>
						<span>Update Ratings</span>
					</button>
				</a>
			</div>
		</div>
		<div class="widget-content">
			<table class="table-condensed message-table" width="100%">
				<tr>
					<th>Tee</th>
					<th>Sex</th>
					<th>Holes</th>
					<th>Par</th>
					<th>Scratch</th>
					<th>Slope</th>
				</tr>
				<tr ng-repeat="rating in ratings">
					<td><% rating.tee_name %></td>
					<td><% rating.tee_sex %></td>
					<td><% rating.holes %></td>
					<td><% rating.par %></td>
					<td><% rating.scratch %></td>
					<td><% rating.slope %></td>
				</tr>
			</table>
		</div>
	</div>
</section>