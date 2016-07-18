@extends('layouts.app')


@section('content')
    <h1>Ordonner la catégorie : {{ $category->name }}</h1>

    {!! Form::open([ 'url' => route('forum.subcategories.storeOrder', $category)]) !!}
    <table>
        <tr>
            <td>Nom</td>
            <td>Ordre</td>
        </tr>
        @foreach($category->subcategory as $s)
            <tr>
                <td>{!! Form::label($s->id, $s->name) !!}</td>
                <td>{!! Form::number($s->id, $s->order) !!}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit">Enregistrer</button>
    {!! Form::close() !!}
@endsection