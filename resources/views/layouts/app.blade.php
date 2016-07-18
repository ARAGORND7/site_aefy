<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page_title }} | Aefy-Esport</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/bootswatch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
<nav class="navbar navbar-default row">
    <div class="container row">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                Aefy Esport
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Accueil</a></li>
                <li><a href="{{ url('/teams') }}">Nos équipes</a></li>
                <li><a href="{{ url('/association') }}">L'association</a></li>
                <li><a href="{{ url('/forum') }}">Forum</a></li>
                <li><a href="{{ url('/sponsor/index') }}">Sponsors</a></li>
                <li><a href="{{ url('/gallery') }}">Gallerie</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
                <li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DKW9W5U2GBSNN"
                       class="darker">Faire un don</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (!Auth::check())
                    <li><a href="{{ url('/login') }}">Se connecter</a></li>
                    <li><a href="{{ url('/register') }}" class="darker">S'inscrire</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->nickname }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.edit',Auth::user()->id) }}">Profil</a></li>
                            @if(Auth::check() && Auth::user()->hasRole('Administrateur'))
                                <li><a href="{{route('admin.index')}}">Administration</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Se déconnecter</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="logo-main">
                <img src="{{URL::asset('img/design/logo.png')}}" alt="Logo de la Team AEFY Sport"
                     title="Team AEFY EsportClub Logo officiel"/>
                <img src="{{URL::asset('img/design/titre.png')}}" alt="Titre du site web de l'équipe AEFY : EsportClub"
                     title="Team AEFY EsportClub Titre du site officiel"/>
            </div>
        </div>
        <div class="hidden-xs col-sm-6">
            <div class="hidden-sm hidden-xs row">
                <div class="col-md-7 slider-main">
                    <ul class="slider">
                        @foreach (\App\Sponsor::all() as $s)
                            @if ($s->picture)
                                <li><a href="{{ $s->url }}" class="sponsor"><img src="{{ url($s->picture) }}"
                                                                                 alt="{{ $s->name }}"/></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">

                @yield('content')
                @extends('layouts.session_messages')
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="logo-main">
                            <img src="{{URL::asset('img/design/logo.png')}}" height="200px"/>
                            <img src="{{URL::asset('img/design/titre.png')}}" height="200px"/>
                            <p style="color:#FFF;padding-left:50px;">Copyright © Team Aefy Esport Club 2015 - 2016.
                                <br/>All right reserved. Une association, un blason, une passion.
                                <br/>Design by 7even-Design - Coding by Nicolas Albrecht</p>
                        </div>
                    </div>
                    <div class="hidden-sm hidden-xs row col-md-6">
                        <div class="col-md-7 slider-main">
                            <ul class="slider">
                                @foreach (\App\Sponsor::all() as $s)
                                    @if ($s->picture)
                                        <li><a href="{{ $s->url }}" class="sponsor"><img src="{{ url($s->picture) }}"
                                                                                         alt="{{ $s->name }}"/></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ asset('js/slider.js') }}"></script>
<script>
    $('.slider').bxSlider({
        mode: 'horizontal',
        useCSS: false,
        infiniteLoop: true,
        hideControlOnEnd: true,
        speed: 2000,
        pager: false,
        controls: true,
        auto: true,
        pause: 5000,
        randomStart: true,
        slideMargin : -50
    });
</script>
@yield('javascript')
</body>
</html>