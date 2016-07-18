@extends('layouts.app')

@section('content')
<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="panel-heading">
			<h1>S'inscrire sur AEFY Esport</h1>
			</div>
		</div>
	</div>
<div id="register-page">
	<div class="row">
		<div class="col-md-12">
			<div class="panel-body">
    {!! Form::open(['url' => route('users.store'), 'method' => 'POST']) !!}
	<div class="form-group">
					<div class="row">
						<div class="col-md-5  col-xs-12">
        {!! Form::label('email', 'Veuillez entrer une adresse email valide : ') !!}<br></div>
						<div class="col-sm-5  col-xs-12">
        {!! Form::email('email') !!}<br><br></div>
					</div>
				</div>
<div class="form-group">
					<div class="row">
						<div class="col-md-5  col-xs-12">
        {!! Form::label('nickname', 'Veuillez saisir un pseudonyme : ') !!}<br></div>
						<div class="col-sm-5  col-xs-12">
        {!! Form::text('nickname') !!}<br><br></div>
					</div>
				</div>
<div class="form-group">
					<div class="row">
						<div class="col-md-5  col-xs-12">
        {!! Form::label('password', 'Veuillez saisir un mot de passe : ') !!}<br></div>
						<div class="col-sm-5  col-xs-12">
        {!! Form::password('password') !!}<br><br></div>
					</div>
				</div>
<div class="form-group">
					<div class="row">
						<div class="col-md-5  col-xs-12">
        {!! Form::label('password_bis', 'Veuillez confirmer votre mot de passe : ') !!}<br></div>
						<div class="col-sm-5  col-xs-12">
        {!! Form::password('password_confirmation') !!}<br><br></div>
					</div>
				</div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>
    {!! Form::close() !!}
			</div>
		</div>
	</div>
	</div>
@endsection
