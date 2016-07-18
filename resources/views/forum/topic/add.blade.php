@extends('layouts.app')

@section('content')

    <h1>Nouveau sujet</h1>
    @extends('layouts.session_messages')

    {!! Form::open([ 'url' => route('forum.topic.store', $category), 'method' => 'POST']) !!}

    {!! Form::label('subject', 'Sujet :')!!}<br>
    {!! Form::text('subject', null)!!}<br><br>

    {!! Form::label('content', 'Votre message ')!!}<br>
    {!! Form::textarea('content', null)!!}<br><br>

    {!! Form::hidden('forum_subcategory_id', $category->id) !!}

    <button type='submit'>Créer le sujet</button>
    {!! Form::close() !!}

@endsection