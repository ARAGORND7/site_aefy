@extends('layouts.app')
@extends('layouts.session_messages')
@section('content')
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="main-panel col-xs-12 col-md-8">
                <div class="row">
                    <div class="col-xs-12 col-md-8">
                        <div class="panel panel-default">
                            <div id="presentation">
                                <img src="{{URL::asset('img/design/Design-Aefy_03.jpg')}}"
                                     alt="Tournoi AEFY Sport inscriptions ouvertes"
                                     title="Inscrivez-vous tournoi AEFY Sport"
                                     class="news-picture"/>
                            </div>
                            <div class="panel-title panel-title-black flex-vertical">
                                <i class="glyphicon glyphicon-play blue"> </i>
                                <span class="white news-title"> Inscrivez-vous au tournoi AEFY Esport !</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <div class="aefy-tv panel panel-default">
                            <div class="panel-heading">
                                <div class="row dark  panel-heading-tv">
                                    <div class="col-md-5 col-xs-12">
                                        <div class="panel-title tv flex">
                                            <span>Aefy Esport TV</span>
                                        </div>
                                    </div>
                                    <div class="col-md-7 hidden-xs">
                                        <div class="tv-planning-link flex">
                                            <a href="{{route('planning.show')}}">Planning</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <iframe height="350" width="350" frameborder="0" scrolling="no" src="http://www.twitch.tv/aefyesport/embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12">
                <div id="actualites">
                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading ">
                                    <div class="row">
                                        <div class="col-md-5 col-xs-12">
                                            <div class="panel-title home-title flex-vertical">
                                                <img src="{{URL::asset('img/design/arrows_04_right.png')}}"
                                                     class="fleche" alt="fleche gauche">
                                                <span>Actualités</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="item">
                                    <div class="item-heading">
                                        <img src="{{URL::asset('img/design/arrow_02_right.png')}}"
                                             alt="Logo de la Team AEFY Sport"
                                             title="Team AEFY EsportClub Logo officiel"/>
                                        <h3>AEFY officiellement en association</h3>
                                    </div>
                                    <div class="item-pic">
                                        <img src="{{URL::asset('img/design/titre.png')}}" width="100%" height="97px"/>
                                        <div class="item-cat">
                                            <p>NEWS</p>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <p>Encore une avancée extraordinaire pour AEFY. Grâce à la communauté elle même
                                            et toutes les personnes qui nous suivent nous passons des paliers chaque
                                            jours et concrétise beaucoup de projet. Celui-ci...</p>
                                    </div>
                                    <div class="item-prop">
                                        <div class="item-author-date">
                                            Ecrit par <a href="#">Nitro</a> le 31/01/2015 à 10:35
                                        </div>
                                        <div class="item-readentire">
                                            <a href="#">Lire l'actualité</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item-heading">
                                        <img src="{{URL::asset('img/design/arrow_02_right.png')}}"
                                             alt="Logo de la Team AEFY Sport"
                                             title="Team AEFY EsportClub Logo officiel"/>
                                        <h3>AEFY officiellement en association</h3>
                                    </div>
                                    <div class="item-pic">
                                        <img src="{{URL::asset('img/design/titre.png')}}" width="100%" height="97px"/>
                                        <div class="item-cat">
                                            <p>NEWS</p>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <p>Encore une avancée extraordinaire pour AEFY. Grâce à la communauté elle même
                                            et toutes les personnes qui nous suivent nous passons des paliers chaque
                                            jours et concrétise beaucoup de projet. Celui-ci...</p>
                                    </div>
                                    <div class="item-prop">
                                        <div class="item-author-date">
                                            Ecrit par <a href="#">Nitro</a> le 31/01/2015 à 10:35
                                        </div>
                                        <div class="item-readentire">
                                            <a href="#">Lire l'actualité</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item-heading">
                                        <img src="{{URL::asset('img/design/arrow_02_right.png')}}"
                                             alt="Logo de la Team AEFY Sport"
                                             title="Team AEFY EsportClub Logo officiel"/>
                                        <h3>AEFY officiellement en association</h3>
                                    </div>
                                    <div class="item-pic">
                                        <img src="{{URL::asset('img/design/titre.png')}}" width="100%" height="97px"/>
                                        <div class="item-cat">
                                            <p>NEWS</p>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <p>Encore une avancée extraordinaire pour AEFY. Grâce à la communauté elle même
                                            et toutes les personnes qui nous suivent nous passons des paliers chaque
                                            jours et concrétise beaucoup de projet. Celui-ci...</p>
                                    </div>
                                    <div class="item-prop">
                                        <div class="item-author-date">
                                            Ecrit par <a href="#">Nitro</a> le 31/01/2015 à 10:35
                                        </div>
                                        <div class="item-readentire">
                                            <a href="#">Lire l'actualité</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item-heading">
                                        <img src="{{URL::asset('img/design/arrow_02_right.png')}}"
                                             alt="Logo de la Team AEFY Sport"
                                             title="Team AEFY EsportClub Logo officiel"/>
                                        <h3>AEFY officiellement en association</h3>
                                    </div>
                                    <div class="item-pic">
                                        <img src="{{URL::asset('img/design/titre.png')}}" width="100%" height="97px"/>
                                        <div class="item-cat">
                                            <p>NEWS</p>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <p>Encore une avancée extraordinaire pour AEFY. Grâce à la communauté elle même
                                            et toutes les personnes qui nous suivent nous passons des paliers chaque
                                            jours et concrétise beaucoup de projet. Celui-ci...</p>
                                    </div>
                                    <div class="item-prop">
                                        <div class="item-author-date">
                                            Ecrit par <a href="#">Nitro</a> le 31/01/2015 à 10:35
                                        </div>
                                        <div class="item-readentire">
                                            <a href="#">Lire l'actualité</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-pagination">
                                <ul>
                                    <li id="page-1-btn" class="pages-btns page-active"><a href="#">1 </a></li>
                                    <li id="page-2-btn" class="pages-btns"><a href="#">2</a></li>
                                    <li class="page-btns-points">...</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-12  col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title home-title flex-vertical">
                                        <img src="{{URL::asset('img/design/arrows_04_right.png')}}" class="fleche"
                                             alt="fleche gauche">
                                        Réseaux sociaux
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="fb-page" data-href="https://www.facebook.com/aefyesport"
                                         data-tabs="timeline" data-height="278" data-small-header="true"
                                         data-adapt-container-width="true" data-hide-cover="false"
                                         data-show-facepile="false">
                                        <div class="fb-xfbml-parse-ignore">
                                            <blockquote cite="https://www.facebook.com/aefyesport"><a
                                                        href="https://www.facebook.com/aefyesport">Aefy</a></blockquote>
                                        </div>
                                    </div>
                                    <br>
                                    <a class="twitter-timeline" href="https://twitter.com/aefy_esport"
                                       data-widget-id="729638732031266816">Tweets de @aefy_esport</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script>!function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = p + "://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs");</script>
@endsection