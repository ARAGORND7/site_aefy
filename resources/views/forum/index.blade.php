@extends('layouts.app')

@section('content')

    <h1>Bienvenue sur le forum</h1>
    @foreach($categories as $c)
        @if($c->is_hidden == false)
            <div class="forum-category-banner" style='background: url("{{ URL::asset($c->picture)}}");'>
                <h2>{{ $c->name }}</h2><br>
                <p>{{ $c->description }}</p>
            </div>
            <table class="table table-hover table-responsive">
                <tbody>
                @foreach ($c->getSubCateg() as $s)
                    <tr>
                        <td><a href="{{route('forum.subcategory.index', $s)}}">{{ $s->name }}</a></td>
                        <td>@if ($s->getLastMessage()) Dernier message:
                            le {{  date('d/m/Y \à H:i', strtotime($s->getLastMessage()->created_at))}},
                            par {{$s->getLastMessage()->user->nickname}} @else Aucun message @endif</td>
                    </tr>
                @endforeach

                </tbody>
            </table><br><br>
        @endif
    @endforeach
    @if(Auth::check() && Auth::user()->hasPermissionTo('Accéder au forum caché'))
        <h3>Forum reservé aux membres autorisés</h3>
        @foreach($categories as $c)
            @if($c->is_hidden == true)
                <div class="forum-category-banner" style='background: url("{{ URL::asset($c->picture)}}");'>
                    <h2>{{ $c->name }}</h2><br>
                    <p>{{ $c->description }}</p>
                </div>
                <table class="table table-hover table-responsive">
                    <tbody>
                    @foreach ($c->getSubCateg() as $s)
                        <tr>
                            <td><a href="{{route('forum.subcategory.index', $s)}}">{{ $s->name }}</a></td>
                            <td>@if ($s->getLastMessage()) Dernier message:
                                le {{  date('d/m/Y \à H:i', strtotime($s->getLastMessage()->created_at))}},
                                par {{$s->getLastMessage()->user->nickname}} @else Aucun message @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table><br><br>
            @endif
        @endforeach
    @endif
@endsection