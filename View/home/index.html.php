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
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>

<?php
    if (AbstractController::userConnected()) { ?>
        <span id="add"><i class="fa fa-plus-square"></i> Ajouter un lien</span>
        <div class="links" id="formAddLink">
            <form action="/index.php?c=links&a=add-links" method="post" id="addLink" enctype="multipart/form-data">
                <div class="inputUser">
                    <label for="link"></label>
                    <input type="text" name="link" id="link" placeholder="Ajouter le lien">
                </div>
                <div class="inputUser">
                    <label for="titleLink"></label>
                    <input type="text" name="titleLink" id="titleLink" placeholder="Titre du lien">
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
    }

    if (AbstractController::userConnected()) { ?>
    <div id="allLink"> <?php
        foreach ($data['show_link']as $links) {
            /* @var \App\Model\Entity\Links $links */ ?>
            <div class="linkDisplay">
                <img src="/links/<?= $links->getLinksImage() ?>" alt="">
                <a href="<?= $links->getLinksName() ?>" class="linkImage"><?= $links->getTitleLinks() ?></a>
                <a href="/index.php?c=links&a=delete-links&id=<?= $links->getId() ?>"><i class="fa fa-remove"></i></a>
            </div> <?php
        } ?>
    </div> <?php
    } ?>

</body>
</html>