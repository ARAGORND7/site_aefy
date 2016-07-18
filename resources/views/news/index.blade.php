@extends('layouts.app')

@section('content')

    <h1>Test</h1>

    @extends('layouts.session_messages')

    @foreach($news as $n)
    <h3>{{ $n->title}}</h3>
    @endforeach

@endsection