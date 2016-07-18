@extends('layouts.app')

@section('content')
<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="panel-heading">
				<div class="panel-title">
					<h1>Mot de passe oublié </h1>
				</div>
			</div>
		</div>
	</div>
    
	<div class="login-page">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-body">
    {!! Form::open(['url' => route('users.storeEmailFormForPasswordReset'), 'method' => 'POST']) !!}
<div class="form-group">
						<div class="row">
							<div class="col-md-7  col-xs-12">
    {!! Form::label('email', 'Veuillez entrez votre adresse email afin que nous vous envoyons un lien de confirmation : ') !!}
	</div>
	</div>
	<div class="row">
							<div class="col-sm-7  col-xs-12">
    {!! Form::email('email') !!}<br><br>
</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-7 col-xs-12">
    <button type="submit" class="btn btn-primary">Envoyer</button>
	</div>
						</div>
					</div>
    {!! Form::close() !!}
	</div>
			</div>
		</div>
	</div>
@endsection