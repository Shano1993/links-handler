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



<header>
    <div>
        <a href="/index.php?c=home" id="title">Links Handler</a> <?php
        if (!AbstractController::userConnected()) { ?>
            <a href="/index.php?c=user&a=login" id="login">Connexion</a>
            <a href="/index.php?c=user&a=register" id="inscription">Inscription</a> <?php
        }
        else { ?>
            <a href="/index.php?c=user&a=profile" id="profile"><?= $_SESSION['user']->getUsername() ?></a>
            <a href="/index.php?c=user&a=logout" id="logout">Deconnexion</a> <?php
        } ?>
    </div>
</header>

<p><?= $html ?></p>

<div id="container">

</div>

<script src="/build/js/front-bundle.js"></script>
</body>
</html>