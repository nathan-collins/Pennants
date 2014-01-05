@extends('layouts.layout')

@section('content')
<div><?php echo Form::open()?></div>
	<div><?php echo Form::label('club_id', 'Club ID')?><?php echo Form::select('club_id', $clubs, $game['club_id'])?></div>
	<div><?php echo Form::label('opponent_id', 'Opponent ID')?><?php echo Form::select('opponent_id', $clubs, $game['opponent_id'])?></div>
	<div><?php echo Form::label('host_id', 'Host ID')?><?php echo Form::select('host_id', $clubs, $game['host_id'])?></div>
	<div><?php echo Form::label('player_id', 'Player ID')?><?php echo Form::text('player_id', $players, $game['player_id'])?></div>
	<div><?php echo Form::label('versus_id', 'Versus ID')?><?php echo Form::text('versus_id', $players, $game['versus_id'])?></div>
	<div><?php echo Form::label('game_date', 'Game Date')?><?php echo Form::text('game_date', $game['game_date'])?></div>
<div><?php echo Form::close()?></div>
@stop