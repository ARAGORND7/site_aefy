@extends('layouts.app')

@section('content')

    <h1>Edition de profil </h1>
    <i>Vous pouvez laisser vide les champs que vous ne souhaitez pas remplir</i>

    {!! Form::model($user, ['files' => true]) !!}

    {!! Form::label('nickname', 'Votre pseudonyme : ') !!}<br>
    {!! Form::text('nickname', null) !!}<br><br>

    {!! Form::label('email', 'Votre adresse email : ') !!}<br>
    {!! Form::email('email', null) !!}<br><br>

    {!! Form::label('last_name', 'Votre nom : ') !!}<br>
    {!! Form::text('last_name', null) !!}<br><br>

    {!! Form::label('first_name', 'Votre prénom : ') !!}<br>
    {!! Form::text('first_name', null) !!}<br><br>

    {!! Form::label('gender', 'Votre sexe : ') !!}<br>
    {!! Form::select('gender', array('null' => 'Selectioner', '1' => 'Masculin', '2' => 'Féminin'), null)!!}<br><br>

    {!! Form::label('date_of_birth', 'Votre date de naissance : ') !!}<br>
    {!! Form::date('date_of_birth', null) !!}<br><br>

    {!! Form::label('country', 'Votre pays : ') !!}<br>
    {!! Form::text('country', null) !!}<br><br>

    {!! Form::label('city', 'Votre ville : ') !!}<br>
    {!! Form::text('city', null) !!}<br><br>

    {!! Form::label('game', 'Vos jeux (separés par un ";") : ') !!}<br>
    {!! Form::text('game', null) !!}<br><br>

    {!! Form::label('signature', 'Votre signature de forum : ') !!}<br>
    {!! Form::text('signature', null) !!}<br><br>

    {!! Form::label('avatar', 'Votre avatar : ') !!}<br>
    @if($user->avatar)
        <img src="{{ url($user->avatar) }}"/><br><br>
    @endif
    {!! Form::file('avatar') !!}<br><br>

    <button type="submit">Enregistrer</button>
    {!! Form::close() !!}<br><br>
@endsection