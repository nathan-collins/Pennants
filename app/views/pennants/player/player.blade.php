@extends('layouts.backend')

@section('title')
<?php echo $player->name?>
@stop

@section('footer_scripts')
{{ HTML::script('scripts/controllers/pennants/PlayerController.js') }}
{{ HTML::script('scripts/directives/seasonDirective.js') }}
{{ HTML::script('scripts/directives/gradeDirective.js') }}
{{ HTML::script('scripts/directives/clubDirective.js') }}
@stop

@section('content')
<div class="col-md-6 content-container">
  <section ng-controller="PlayerController">
		<h1><?php echo $player->name?></h1>
		<?php if(count($player_seasons) > 0):?>
			<table class="table table-condensed table-hover">
				<tr>
					<th>Season</th>
					<th>Club</th>
					<th>Grade</th>
					<th></th>
					<th></th>
				</tr>
				<?php foreach($player_seasons as $player_season):?>
	      <tr>
					<td season_id="<?php echo $player_season->season_id ?>" season-text></td>
					<td club_id="<?php echo $player_season->club_id ?>" club-text></td>
					<td grade_id="<?php echo $player_season->grade_id ?>" grade-text></td>
					<td width="40px">
						<a ng-href="/dashboard/pennants/match/<% match.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="fa fa-eye" title="Matches"></span>
							</button>
						</a>
					</td>
					<td width="40px">
						<a ng-href="/dashboard/pennants/match/<% match.id %>">
							<button type="button" class="btn btn-default btn-sm">
								<span class="fa fa-list" title="Matches"></span>
							</button>
						</a>
					</td>
	      </tr>
				<?php endforeach;?>
			</table>
		<?php endif;?>
  </section>
</div>
@stop