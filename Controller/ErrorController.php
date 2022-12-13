<?php

namespace App\Controller;

class ErrorController
{
    /**
     * @param string $page
     * @return void
     */
    public function error404(string $page)
    {
        require __DIR__ . '/../View/error/error404.html.php';
    }

    /**
     * @return void
     */
    public function missingParameters()
    {
        require __DIR__ . '/../View/error/missing-parameters.html.php';
    }
}
