<?php

use App\Controller\AbstractController;

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Links Handler</title>
    <link rel="stylesheet" href="/build/css/front.css">
</head>
<body>

<?php
    if (AbstractController::userConnected()) { ?>
        <div class="links">
            <a href=""> + Ajouter un lien</a>
        </div> <?php
    }
    else { ?>
        <div class="links">
            <a href="/index.php?c=user&a=login">Veuillez vous connecter pour utiliser l'application</a>
        </div> <?php
    }?>

</body>
</html>