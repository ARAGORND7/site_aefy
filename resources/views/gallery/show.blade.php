@extends('layouts.app')

@section('content')

    <h1>{{ $album->name }}</h1>

    <p>{{ $album->description }}</p>
    @if (Auth::user()->hasPermissionTo('Gérer la gallerie'))
        <a href="{{route('gallery.album.edit', $album)}}">
            <button type="button">Modifier l'album</button>
        </a>
        <a href="{{route('gallery.album.delete', $album)}}">
            <button type="button">Supprimer l'album</button>
        </a>
    @endif
    @if($filecount == 0)

        <i>Aucune image n'a été trouvée dans cette album.</i>

    @else
        <p>
            @foreach($files as $file)
                @if($file->getFilename() !== "cover.jpg")
                    <img src="{{url($urldirectory.$file->getFilename())}}" alt="Erreur"/>
                @endif
            @endforeach
        </p>
    @endif

    @if (Auth::user()->hasPermissionTo('Gérer la gallerie'))
        <a href="{{route('gallery.album.edit', $album)}}">
            <button type="button">Modifier l'album</button>
        </a>
        <a href="{{route('gallery.album.delete', $album)}}">
            <button type="button">Supprimer l'album</button>
        </a>
    @endif
@endsection