@extends('layouts.app')

@section('content')

    <h1>Ajout d'une catégorie</h1>
    @extends('layouts.session_messages')

    {!! Form::open([ 'url' => route('forum.categories.store'), 'files' => true]) !!}

    {!! Form::label('name', 'Nom de la nouvelle catégorie :')!!}<br>
    {!! Form::text('name', null)!!}<br><br>

    {!! Form::label('description', 'Description de la catégorie : ') !!}<br>
    {!! Form::textarea('description') !!}<br><br>

    {!! Form::label('picture', 'Bannière de la catégorie : ') !!}<br>
    {!! Form::file('picture') !!}<br><br>

    {!! Form::label('is_hidden', 'Cacher la catégorie ?')!!}<br>
    {!! Form::checkbox('is_hidden', 1 )!!}<br><br>

    <button type='submit'>Ajouter</button>
    {!! Form::close() !!}

@endsection