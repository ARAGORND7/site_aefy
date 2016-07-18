@extends('layouts.app')

@section('content')

    <h1>Mot de passe oublié </h1>
    {!! Form::open(['url' => route('users.storePasswordReset', [$tokenDatabase->token, $tokenDatabase->email]), 'method' => 'POST']) !!}

    {!! Form::label('password', 'Veuillez saisir votre nouveau mot de passe : ') !!}<br>
    {!! Form::password('password') !!}<br><br>

    {!! Form::label('password_confirmation', 'Veuillez confirmez votre nouveau mot de passe : ') !!}<br>
    {!! Form::password('password_confirmation') !!}<br><br>

    <button type="submit">Envoyer</button>
    {!! Form::close() !!}<br><br>
@endsection