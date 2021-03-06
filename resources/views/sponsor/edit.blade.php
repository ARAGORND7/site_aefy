@extends('layouts.app')

@section('content')

    <h1>Création d'une news</h1>
    @extends('layouts.session_messages')

    {!! Form::open([ 'url' => route('sponsor.update', $sponsor), 'method' => 'POST', 'files' => true]) !!}

    {!! Form::label('name', 'Nom du sponsor :')!!}<br>
    {!! Form::text('name', $sponsor->name)!!}<br><br>

    {!! Form::label('url', 'Lien vers le site du sponsor : ')!!}<br>
    {!! Form::text('url', $sponsor->url)!!}<br><br>

    {!! Form::label('picture', 'Logo du sponsor : ') !!}<br>
    {!! Form::file('picture') !!}<br><br>

    {!! Form::label('description', 'Description du sponsor ')!!}<br>
    {!! Form::textarea('description', $sponsor->description)!!}<br><br>

    {!! Form::label('sponsor_category', 'Type du sponsor : ') !!}<br>
    {!! Form::select('sponsor_category', $categories, null) !!}<br><br>

    <button type='submit'>Modifier</button>
    {!! Form::close() !!}

@endsection