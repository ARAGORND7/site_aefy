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
    <h1>Gestion des permissions</h1>

    {!! Form::open([ 'url' => route('admin.permissions.edit')]) !!}
    @foreach($roles as $r)
        @if ($r->name !== 'Administrateur')
            <h4>{{$r->name }}</h4>

            @foreach($permissions as $p)
                <span style="display: none;">
            {!! $perm = \Illuminate\Support\Facades\DB::table('role_has_permissions')->wherePermissionId($p->id)->whereRoleId($r->id)->count() !!}
            </span>
                {{ $p->name }}
                @if ($perm === 1)
                    {!! Form::label($r->id.'['.$p->id.']', 'Autoriser') !!}{!! Form::radio($r->id.'['.$p->id.']','grant', true ) !!}
                    {!! Form::radio($r->id.'['.$p->id.']', 'forbid') !!}{!! Form::label($r->id.'['.$p->id.']', 'Refuser') !!}
                @else
                    {!! Form::label($r->id.'['.$p->id.']', 'Autoriser') !!}{!! Form::radio($r->id.'['.$p->id.']', 'grant' ) !!}
                    {!! Form::radio($r->id.'['.$p->id.']', 'refuse', true) !!}{!! Form::label($r->id.'['.$p->id.']', 'Refuser') !!}
                @endif<br>
            @endforeach

        @endif
    @endforeach

    <button type="submit">Enregistrer</button>
    {!! Form::close() !!}
@endsection