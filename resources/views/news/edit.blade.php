@extends('layouts.app')

@section('content')

    <h1>Edition de la news {{ $news->id }}</h1><br>

    @extends('layouts.session_messages')

    {!! Form::model($news, ['method' => 'PUT', 'url' => route('news.update', $news), 'files' => true]) !!}
    {!! Form::label('title', 'Titre de la news :')!!}<br>
    {!! Form::text('title', null)!!}<br><br>

    {!! Form::label('content', 'Contenu de la news : ')!!}<br>
    {!! Form::textarea('content', null)!!}<br><br>

    {!! Form::label('picture', 'Image de couverture de la news : ') !!}<br>
    {!! Form::file('picture', null) !!}<br><br>

    {!! Form::label('newsCategory_id', 'Catégories de la news : ') !!}<br>
    {!! Form::select('newsCategory_id', $categories, null) !!}<br><br>

    {!! Form::label('online', 'Souhaitez-vous publier cette news maintenant ?') !!}{!! Form::checkbox('online',1,null) !!}<br><br>
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