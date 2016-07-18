@extends('layouts.app')

@section('content')
    <h1>Liste des bannis</h1>

    <table>
        <tr>
            <td>Id</td>
            <td>Nom</td>
            <td>Banni par</td>
            <td>Date de début</td>
            <td>Date de fin</td>
            <td>Raison</td>
            <td>Actions</td>
        </tr>

        @foreach($banList as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->banned->nickname }}</td>
                <td>{{ $b->banCreator->nickname }}</td>
                <td>{{ date('d/m/Y \à H:i', strtotime($b->created_at)) }}</td>
                @if($b->end_date !== null)
                    <td>{{ date('d/m/Y \à H:i', strtotime($b->end_date)) }}</td>
                @else
                    <td>Permanent</td>
                @endif
                <td>{{ $b->reason }}</td>
                <td><a href="">Modifier</a><a href="">Supprimer</a></td>
            </tr>
        @endforeach

        {!! $banList->links() !!}
    </table>
@endsection