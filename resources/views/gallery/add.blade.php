@extends('layouts.app')

@section('content')
    <h1>Nouvel album</h1>

    {!! Form::open(['url' => route('gallery.album.create'), 'method' => 'POST', 'files' => true]) !!}

    {!! Form::label('name', 'Nom de l\'album : ') !!}<br>
    {!! Form::text('name') !!}<br><br>

    {!! Form::label('description', 'Description de l\'album : ') !!}<br>
    {!! Form::textarea('description') !!}<br>

    {!! Form::label('cover', 'Image de couverture : ') !!}<br>
    {!! Form::file('cover') !!}<br><br>

    {!! Form::label('images', 'Image(s) composant(s) l\'album') !!}<br>
    {!! Form::file('images[]', ['multiple' => true]) !!}<br><br>

    {!! Form::hidden('user_id', Auth::user()->id) !!}

    <button type="submit">Créer</button>
    {!! Form::close() !!}

@endsection