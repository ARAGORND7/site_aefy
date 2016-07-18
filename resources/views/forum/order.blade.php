@extends('layouts.app')

@section('content')

    <h1>Organiser le forum</h1>

    <a href="{{route('forum.categories.add')}}">
        <button type="button">Ajouter une catégorie</button>
    </a><a href="{{route('forum.subcategories.add')}}">
        <button type="button">Ajouter une sous-catégorie</button>
    </a><a href="{{route('forum.categories.order')}}">
        <button type="button">Ordonner les catégories</button>
    </a>

    <br><br>
    <ul>
        @foreach($categories as $c)
            <li>{{ $c->name }}<a href="{{route('forum.subcategories.order', $c)}}">Ordonner la catégorie</a> <a
                        href="{{route('forum.categories.edit', $c)}}">Modifier</a><a
                        href="{{route('forum.categories.delete', $c)}}"> Supprimer</a>
                <ul>
                    @foreach ($c->getSubCateg() as $s)
                        <li>{{ $s->name }} <a href="{{route('forum.subcategories.edit', $s)}}">Modifier</a><a
                                    href="{{route('forum.subcategories.delete', $s)}}"> Supprimer</a></li>

                    @endforeach
                </ul>
            </li>
        @endforeach<br>
    </ul>

@endsection