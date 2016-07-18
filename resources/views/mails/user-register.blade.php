Bonjour {{ $user->nickname }}, <br><br>

Nous vous remercions de votre inscript sur Aefy-Esport.<br>
Avant de pouvoir vous connecter, nous devons valider votre adresse mail.<br><br>

Pour cela, veuillez cliquez sur le lien suivant ou le copier/coller dans la barre de votre navigateur : <a href="">{{ url('/confirm', [$user->id, $token]) }}</a><br><br>

A bientôt sur notre site,<br><br>

L'équipe Aefy-Esport