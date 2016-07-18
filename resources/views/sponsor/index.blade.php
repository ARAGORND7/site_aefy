@extends('layouts.app')


@section('content')
    <h1>Ils nous soutiennent</h1><br>

    @foreach($sponsors as $s)
        <p>
            <a href="{{url($s->url)}}">
                <img src="{{url('img/sponsor/'.$s->id.'.jpg')}}" alt="Erreur"/><br>
                {{ $s->name }}
            </a>
            {{ $s->description }}
        </p>
    @endforeach

    {{ $sponsors->links() }}
@endsection