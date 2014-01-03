<?php foreach($errors->all() as $message):?>
	<p><?php echo $message;?></p>
<?php endforeach;?>
<?php echo Form::open()?>
<div class="player-name"><?php echo Form::label('name', 'Player Name')?><?php echo Form::text('name')?></div>
<div class="player-handicap"><?php echo Form::label('handicap', 'Handicap')?><?php echo Form::text('handicap')?></div>
<div class="player-golf_link_number"><?php echo Form::label('golf_link_number', 'Golf Link Number')?><?php echo Form::text('golf_link_number')?></div>
<div class="player-submit"><?php echo Form::submit('Submit Player')?></div>
<?php echo Form::close()?>