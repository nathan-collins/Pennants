@extends('layouts.layout')


@section('content')
<h1>Edit a Season</h1>
<?php if($errors->any()):?>
    <ul>
      <?php echo implode('', $errors->all('<li>:message</li>'))?>
    </ul>
<?php endif;?>
<?php echo Form::model($season, array('route' => array('api.v1.pennants.season.update', $season->id), 'method' => 'PUT'))?>
<div class="season-year"><?php echo Form::label('year', 'Year')?><?php echo Form::text('year', $season->year)?></div>
<div class="season-name"><?php echo Form::label('name', 'Name')?><?php echo Form::text('name', $season->name)?></div>
<div class="season-submit"><?php echo Form::submit('Submit')?></div>
<?php echo Form::close()?>
@stop