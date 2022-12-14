<?php

use App\Controller\AbstractController;

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']); ?>
    <div class="error"><?= $errors ?></div> <?php
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']); ?>
    <div class="success"><?= $success ?></div> <?php
} ?>



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
        <h1 id="title">Links Handler</h1> <?php
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

<script src="/build/js/front-bundle.js"></script>
</body>
</html>