@extends('layouts.app')
/** MENU ADMINSTRATEUR **/
<ul>
    <li><a href="{{route('admin.index')}}">Tableau de bord</a></li>
    <li><a href="{{route('admin.news')}}">News</a></li>
    <li><a href="{{route('admin.permissions')}}">Permissions</a></li>
    <li><a href="{{route('admin.sponsor')}}">Sponsors</a></li>
    <li><a href="{{route('admin.pages')}}">Pages de présentations</a></li>
    <li><a href="{{route('admin.members')}}">Membres</a></li>
    <li><a href="{{route('gallery.index')}}">Gallerie</a></li>
    <li><a href="{{route('forum.categories.order')}}">Catégories du forum</a></li>
</ul>
@section('content')

    <h1>Gestion des news</h1>

    <a href="{{ route('news.create') }}">Créer une news</a>
    <table>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Date de création</td>
            <td>Publié ? </td>
            <td>Actions</td>
        </tr>

        @foreach($news as $n)
            @if($n->online == 1)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->title }}</td>
                    <td>Le {{ date('d/m/Y', strtotime($n->created_at)) }}
                        à {{date('H:i', strtotime($n->created_at))}}</td>
                    <td>Oui</td>
                    <td>
                        <a href="{{route('news.edit', $n)}}">Modifier cette news</a>
                        <a href="{{route('news.destroy', $n)}}">Supprimer cette news</a>
                    </td>
                </tr>
            @else
                <tr>
                    <td><i>{{ $n->id }}</i></td>
                    <td><i>{{ $n->title }}</i></td>
                    <td><i>Le {{ date('d/m/Y', strtotime($n->created_at)) }}
                        à {{date('H:i', strtotime($n->created_at))}}</i></td>
                    <td><i>Non</i></td>
                    <td>
                        <a href="{{route('news.edit', $n)}}">Modifier cette news</a>
                        <a href="{{route('news.destroy', $n)}}">Supprimer cette news</a>
                    </td>
                </tr>
            @endif
        @endforeach
    </table><br><br>
    <a href="{{ route('news.create') }}">Créer une news</a><br><br>
    {!! $news->links() !!}
@endsection