@extends('layouts.app')

@section('content')

    <h1>Edition de la page : {{ $page->title}}</h1><br>

    @extends('layouts.session_messages')

    {!! Form::model($page, ['method' => 'PUT', 'url' => route('pages.update', $page)]) !!}
    {!! Form::label('title', 'Titre de la page :')!!}<br>
    {!! Form::text('title', null)!!}<br><br>

    {!! Form::label('content', 'Contenu de la page : ')!!}<br>
    {!! Form::textarea('content', null) !!}<br><br>


    <button type='submit'>Envoyer</button>
    {!! Form::close() !!}

@endsection
@section('javascript')
    <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
    <script type="text/javascript">
        $('textarea').ckeditor();
    </script>
@endsection