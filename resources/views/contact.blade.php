@extends('layouts.app')

@section('content')
    <h1>Contact</h1>

    {!! Form::open([ 'url' => route('contact.store')]) !!}

    {!! Form::label('to', 'Destinataire : ') !!}<br>
    {!! Form::select('to', [
        'Général'               => 'Général',
        'Président'             => 'Président',
        'Trésorier'             => 'Trésorier',
        'Webmaster'             => 'Webmaster'
    ]) !!}<br><br>

    {!! Form::label('name', 'Votre nom : ') !!}<br>
    {!! Form::text('name') !!}<br><br>

    {!! Form::label('email', 'Votre adresse email : ') !!}<br>
    {!! Form::email('email') !!}<br><br>

    {!! Form::label('subject', 'Sujet du message : ') !!}<br>
    {!! Form::text('subject') !!}<br><br>


    {!! Form::label('message', 'Votre message : ') !!}<br>
    {!! Form::textarea('message') !!}<br><br>

    <button type="submit">Envoyer</button>
    {!! Form::close() !!}
@endsection
