@extends('layouts.app')

@section('content')

    <h1>{{ $news->title }}</h1>
    <i>Publié par {{ $news->user->nickname }}, le {{ date('d/m/Y \à H:i', strtotime($news->created_at)) }}</i>
    <p>
        {!! html_entity_decode($news->content) !!}
    </p>
@endsection