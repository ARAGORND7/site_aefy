@extends('layouts.app')

@section('content')

    <h1>Ajouter une sous-catégorie</h1>
    @extends('layouts.session_messages')

    {!! Form::open([ 'url' => route('forum.subcategories.store')]) !!}

    {!! Form::label('name', 'Nom de la sous-catégorie:')!!}<br>
    {!! Form::text('name', null)!!}<br><br>

    {!! Form::label('forum_category_id', 'Catégorie associé : ') !!}<br>
    {!! Form::select('forum_category_id', $forum_categories, null) !!}<br><br>

    {!! Form::label('is_locked', 'Si vous cochez cette case, seuls les personnes ayant la permission pourront ouvrir un topic dans cette catégorie : ') !!}<br>
    {!! Form::checkbox('is_locked', true) !!}<br><br>

    <button type='submit'>Ajouter</button>
    {!! Form::close() !!}

@endsection