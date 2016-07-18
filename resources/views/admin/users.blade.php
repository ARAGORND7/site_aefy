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

    <h1>Gestion des membres</h1>

    <table>
        <tr>
            <td>ID</td>
            <td>Pseudonyme</td>
            <td>Adresse email</td>
            <td>Date d'inscription</td>
            <td>Action</td>
        </tr>

        @foreach($users as $u)
            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->nickname }}</td>
                <td>{{ $u->email }}</td>
                <td>Le {{ date('d/m/Y', strtotime($u->created_at)) }}
                    à {{date('H:i', strtotime($u->created_at))}}</td>
                <td>Oui</td>
                <td>
                    <a href="{{route('users.edit', $u)}}">Modifier</a>
                    @if (DB::table('users_ban')->where('user_id', $u->id)->count() === 0)
                        <a href="{{route('admin.ban.create', $u)}}">Bannir</a>
                    @else
                        <a href="{{route('admin.ban.edit', $u)}}">Modifier le ban</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {!! $users->links() !!}
@endsection