<?php

require __DIR__ . '/Config.php';
require __DIR__ . '/Model/DB.php';

require __DIR__ . '/Model/Entity/AbstractEntity.php';
require __DIR__ . '/Model/Entity/User.php';
require __DIR__ . '/Model/Entity/Links.php';

require __DIR__ . '/Model/Manager/UserManager.php';
require __DIR__ . '/Model/Manager/LinksManager.php';

require __DIR__ . '/Controller/AbstractController.php';
require __DIR__ . '/Controller/ErrorController.php';
require __DIR__ . '/Controller/HomeController.php';
require __DIR__ . '/Controller/UserController.php';
require __DIR__ . '/Controller/LinksController.php';

require __DIR__ . '/Routing/AbstractRouter.php';
require __DIR__ . '/Routing/HomeRouter.php';
require __DIR__ . '/Routing/UserRouter.php';
require __DIR__ . '/Routing/LinksRouter.php';