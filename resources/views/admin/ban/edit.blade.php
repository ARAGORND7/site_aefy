@extends('layouts.app')


@section('content')

    <h1>Editer le ban de : {{ $ban->banned->nickname }}</h1><br>

    {!! Form::open([ 'url' => route('admin.ban.update', $ban), 'method' => 'POST']) !!}

    {!! Form::label('end_date', 'Nombre de jour à rajouter ou à retirer : (0 si aucune modification souhaitée) ') !!}<br>
    {!! Form::number('end_date', 0) !!}<br><br>

    {!! Form::label('reason', 'Raison du ban : ') !!}<br>
    {!! Form::text('reason', $ban->reason) !!}<br><br>

    <button type="submit">Editer</button>
    {!! Form::close() !!}
@endsection