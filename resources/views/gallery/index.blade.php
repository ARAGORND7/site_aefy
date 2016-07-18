@extends('layouts.app')

@section('content')
    <h1>Gallery d'Aefy Esport</h1>

    @foreach ($albums as $a)
        <div>
            <a href="{{ route('gallery.album.show', $a) }}">
                <img src="{{ url($directory . $a->id. "/cover.jpg") }}" alt="Erreur"/><br>
                <i>{{ $a->name }}</i>
            </a>
        </div>
    @endforeach

@endsection