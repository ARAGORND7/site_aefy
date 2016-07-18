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

    <h1>Gestion des sponsors</h1>

    <a href="{{ route('sponsor.add') }}">Ajouter un sponsor</a>
    <table>
        <tr>
            <td>ID</td>
            <td>Nom</td>
            <td>Catégorie</td>
            <td>Actions</td>
        </tr>

        @foreach($sponsor as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->category->label }}</td>
                <td>
                    <a href="{{route('sponsor.edit', $s)}}">Modifier</a>
                    <a href="{{route('sponsor.delete', $s)}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
    </table><br><br>
    <a href="{{ route('sponsor.add') }}">Ajouter un sponsor</a>
    {!! $sponsor->links() !!}
@endsection