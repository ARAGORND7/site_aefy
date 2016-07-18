<span style="display:none">{!! date_default_timezone_set('Europe/Paris') !!}</span>

Bonjour,<br><br>

Vous avez demandé à changer votre mot de passe le <b>{{ date('d/m/Y \à H:i')}}</b>.<br>
Pour finaliser l'opération, veuillez cliquer sur <a href="{{ $link = url('/password/reset', $token).'/'.urlencode($email) }}">ce lien</a>.<br><br>

<i>Note: Si vous n'êtes pas à l'origine de cette demande, merci d'ignorer ce message et de contacter un administrateur.</i><br><br>

A bientôt sur notre site, <br><br>

L'équipe Aefy-Esport.