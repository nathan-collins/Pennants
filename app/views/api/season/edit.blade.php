<h1>Edit a Season</h1>
<?php echo Form::open()?>
<div class="season-year"><?php echo Form::label('year', 'Year')?><?php echo Form::text('year', $season['year'])?></div>
<div class="season-name"><?php echo Form::label('name', 'Name')?><?php echo Form::text('name', $season['name'])?></div>
<div class="season-submit"><?php echo Form::submit('Submit')?></div>
<?php echo Form::close()?>