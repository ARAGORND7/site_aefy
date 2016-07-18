@extends('layouts.app')

@section('content')

    <h1>Organiser les catégories du forum</h1>


    {!! Form::open([ 'url' => route('forum.categories.storeOrder')]) !!}
    <table>
        <tr>
            <td>Nom</td>
            <td>Ordre</td>
        </tr>
        @foreach($categories as $c)
            <tr>
                <td>{!! Form::label($c->id, $c->name) !!}</td>
                <td>{!! Form::number($c->id, $c->order) !!}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit">Enregistrer</button>
    {!! Form::close() !!}
@endsection