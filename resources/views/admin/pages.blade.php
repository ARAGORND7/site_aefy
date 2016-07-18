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

    <h1>Gestion des Pages</h1><br>

    <i>Ici, vous pouvez gérer les pages indépendantes du site.</i><br><br>
    <table>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Dernière mise à jour</td>
            <td>Actions</td>
        </tr>

        @foreach($pages as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->title }}</td>
                <td>Le {{ date('d/m/Y', strtotime($p->updated_at)) }}
                    à {{date('H:i', strtotime($p->updated_at))}}</td>
                <td>
                    <a href="{{route('pages.edit', $p)}}">Modifier</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection