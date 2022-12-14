<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Profil de <?= $_SESSION['user']->getUsername() ?></h1>

    <div class="infoUser">
        <p>Votre email</p>
        <p><?= $_SESSION['user']->getEmail() ?></p>
    </div>

    <div class="infoUser">
        <p>Votre nom d'utilisateur</p>
        <p><?= $_SESSION['user']->getUsername() ?></p>
    </div>

    <div class="infoUser">
        <p>Votre mot de passe</p>
        <p>*******</p>
    </div>

    <a href="/index.php?c=user&a=delete-account&id=<?= $_SESSION['user']->getId() ?>" id="deleteAccount">Supprimer le compte</a>

</body>
</html>
