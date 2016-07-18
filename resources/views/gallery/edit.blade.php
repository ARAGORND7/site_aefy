@extends('layouts.app')

@section('content')

    <h1>Edition de l'album {{ $album->name }}</h1>

    <h3>Photos présentes : </h3>
    <p>
        @foreach($files as $file)
            @if($file->getFilename() !== "cover.jpg")
                <img src="{{url($urldirectory.$file->getFilename())}}" alt="Erreur"/><br>
                <a href="{{ route('gallery.picture.delete', [$file->getFilename(), $album->id]) }}">Supprimer</a><br><br>
            @endif
        @endforeach
    </p><br><br>

    <h3>Editer les informations de l'album : </h3>

    {!! Form::open(['url' => route('gallery.album.update', $album), 'method' => 'POST', 'files' => true]) !!}

    {!! Form::label('name', 'Nom de l\'album : ') !!}<br>
    {!! Form::text('name', $album->name) !!}<br><br>

    {!! Form::label('description', 'Description de l\'album : ') !!}<br>
    {!! Form::textarea('description', $album->description) !!}<br>

    {!! Form::label('cover', 'Image de couverture : ') !!}<br>
    {!! Form::file('cover') !!}<br><br>

    {!! Form::label('images', 'Image(s) composant(s) l\'album') !!}<br>
    {!! Form::file('images[]', ['multiple' => true]) !!}<br><br>

    <button type="submit">Modifier</button>
    {!! Form::close() !!}
@endsection