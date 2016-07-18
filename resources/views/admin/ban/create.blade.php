@extends('layouts.app')

@section('content')
    <h1>Bannir : {{ $user->nickname }}</h1>

    {!! Form::open([ 'url' => route('admin.ban.store'), 'method' => 'POST']) !!}

    {!! Form::label('end_date', 'Durée du ban en jours (0 = permanent) : ') !!}<br>
    {!! Form::number('end_date') !!}<br><br>

    {!! Form::label('reason', 'Raison du ban : ') !!}<br>
    {!! Form::text('reason') !!}<br><br>

    {!! Form::hidden('creator', Auth::user()->id) !!}

    {!! Form::hidden('user_id', $user->id) !!}
    <button type="submit">Bannir</button>
    {!! Form::close() !!}

@endsection