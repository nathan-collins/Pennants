<div class="dropdown">
	<button class="btn btn-default dropdown-toggle" type="button" id="match-result" data-toggle="dropdown">
		Result
		<span class="caret"></span>
	</button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="match-result">
		<?php foreach($results as $result):?>
			<li ng-click="setResult(player.id, '<?php echo $result?>', <?php echo $clubId ?>)" role="presentation"><a role="menuitem" tabindex="-1" href="#"><?php echo $result?></a></li>
		<?php endforeach;?>
	</ul>
</div>