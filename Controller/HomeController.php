<?php

namespace App\Controller;

use App\Model\Manager\LinksManager;

class HomeController extends AbstractController
{
    /**
     * @return void
     */
    public function index()
    {
        $this->render('home/index', [
            'show_link' => LinksManager::getAll()
        ]);
    }
}
