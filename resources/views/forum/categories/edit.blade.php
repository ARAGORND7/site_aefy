@extends('layouts.app')

@section('content')

    <h1>Editer une catégorie</h1>
    @extends('layouts.session_messages')

    {!! Form::open([ 'url' => route('forum.categories.update', $category), 'files' => true]) !!}

    {!! Form::label('name', 'Nom de la catégorie :')!!}<br>
    {!! Form::text('name', $category->name)!!}<br><br>

    {!! Form::label('description', 'Description de la catégorie : ') !!}<br>
    {!! Form::textarea('description', $category->description) !!}<br><br>

    {!! Form::label('picture', 'Bannière de la catégorie : ') !!}<br>
        <img src="{{ url($category->picture) }}"/><br><br>
    {!! Form::file('picture') !!}<br><br>

    {!! Form::label('is_hidden', 'Cacher la catégorie ?')!!}<br>
    {!! Form::checkbox('is_hidden', true, null )!!}<br><br>

    <button type='submit'>Modifier</button>
    {!! Form::close() !!}

@endsection