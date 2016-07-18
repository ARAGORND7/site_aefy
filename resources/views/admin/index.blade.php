@extends('layouts.app')

@section('content')
    <h1>Panel d'administration</h1>

    @extends('layouts.menu_admin')
    <div>
        <i>En ce moment</i><br>

        <table>
            <tr>
                <td>{{ $memberscount }} membres enregistrés</td>
                <td>{{ $albumscount }} galleries</td>
            </tr>
            <tr>
                <td>{{ $newscount }} news d'actualités</td>
                <td>{{ $topicscount }} topics sur le forum</td>
            </tr>
        </table>
    </div>
@endsection