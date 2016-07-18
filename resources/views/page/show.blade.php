@extends('layouts.app')

@section('content')

    <h1> {{ $page->title}}</h1><br><br>

    @extends('layouts.session_messages')

    @if(!Auth::guest() && Auth::user()->hasRole('Administrateur'))
        <a href="{{ route('pages.edit', $page) }}" alt="Editer" class="btn btn-info">
            <i class="glyphicon glyphicon-edit"></i>Modifier cet article</a>
        <br><br>
    @endif
    {!! html_entity_decode($page->content) !!}

@endsection