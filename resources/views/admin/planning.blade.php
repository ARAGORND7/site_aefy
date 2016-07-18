@extends('layouts.app')

@section('content')
    <h1>Planning du stream</h1>

    {!! Form::open([ 'url' => route('admin.planning.store'), 'files' => true]) !!}

    {!! Form::label('planning', "Veuillez entrer la nouvelle image du planning : ") !!}<br>
    {!! Form::file('planning') !!}<br><br>

    <button type="submit">Mettre à jour</button>
    {!! Form::close() !!}
@endsection