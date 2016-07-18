@extends('layouts.app')

@section('content')
    <div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="panel-heading">
				<div class="panel-title">
					<h1>Se connecter</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="login-page">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-body">
					{!! Form::open(['url' => route('users.postLogin'), 'method' => 'POST', 'class' => '']) !!}

					<div class="form-group">
						<div class="row">
							<div class="col-md-5  col-xs-12">
							{!! Form::label('nickname', 'Votre pseudonyme : ', ['class' => '']) !!}
							</div>
							<div class="col-sm-5  col-xs-12">
								{!! Form::text('nickname',null, ['class' => '']) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-5 col-xs-12">
							{!! Form::label('password', 'Votre mot de passe : ', ['class' => '']) !!}
							</div>
							<div class="col-sm-5 col-xs-12">
								{!! Form::password('password',['class' => '']) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<button type="submit" class="btn btn-primary">Se connecter</button>
							</div>
						</div>
					</div>
					{!! Form::close() !!}
					<div class="row">
						<div class="col-sm-12">
							<a class="btn btn-link" href="{{ route('users.showEmailFormForPasswordReset') }}">Mot de passe oublié ?</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
