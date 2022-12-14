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
            <form action="/index.php?c=links&a=add-links" method="post" id="addLink" enctype="multipart/form-data">
                <div class="inputUser">
                    <label for="link"></label>
                    <input type="text" name="link" id="link" placeholder="Ajouter le lien">
                </div>
                <div class="inputUser">
                    <label for="imageName"></label>
                    <input type="file" name="imageName" id="file">
                </div>
                <input type="submit" name="save" value="Ajouter" id="submitLink">
            </form>
        </div> <?php
    }
    else { ?>
        <div class="links">
            <a href="/index.php?c=user&a=login">Veuillez vous connecter pour utiliser l'application</a>
        </div> <?php
    }?>

</body>
</html>