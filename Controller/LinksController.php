<?php

namespace App\Controller;

use App\Model\Entity\Links;
use App\Model\Manager\LinksManager;

class LinksController extends AbstractController
{
    public function index()
    {
        $this->render('home/index');
    }

    public function addLinks($directory)
    {
        if (!UserController::userConnected()) {
            header('location: /index.php?c=home');
        }
        if ($this->isFormSubmitted()) {
            if (isset($_FILES["imageName"]) && $_FILES["imageName"]["error"] === 0) {
                $allowedMimeType = ["image/jpeg", "image/jpg", "image/png"];
                if (in_array($_FILES["imageName"]["type"], $allowedMimeType)) {
                    $maxSize = 8 * 1024 * 1024;
                    if ((int)$_FILES["imageName"]["size"] <= $maxSize) {
                        $tmp_name = $_FILES["imageName"]["tmp_name"];
                        $name = $_FILES["imageName"]["name"];
                        $name = $this->getRandomName($name);
                        if (!is_dir($directory)) {
                            mkdir($directory, '0755');
                        }
                        if (AbstractController::checkImageMime($tmp_name)) {
                            if (move_uploaded_file($tmp_name, $directory . $name)) {
                                $linksName = $this->sanitizeString($this->getField('link'));
                                $linksUser = $_SESSION['user'];

                                $links = new Links();
                                $links
                                    ->setLinksImage($name)
                                    ->setLinksName($linksName)
                                    ->setLinksUser($linksUser)
                                    ;
                                if (LinksManager::addNewLinks($links)) {
                                    $this->render('home/index');
                                }
                            }
                        }
                        else {
                            $this->render('home/index'); ?>
                            <div>Pas une image</div> <?php
                        }
                    }
                    else {
                        $this->render('home/index'); ?>
                        <div>Trop gros</div> <?php
                    }
                }
                else {
                    $this->render('home/index'); ?>
                    <div>Mauvais format</div> <?php
                }
            }
            else {
                $this->render('home/index'); ?>
                <div>Erreur</div> <?php
            }
        }
        $this->render('home/index');
    }
}
