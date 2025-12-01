<?php

namespace App\Core;

class App
{
    public function run()
    {
        $router = new Router();
        require_once __DIR__ . '/../../app/routes.php';
        $router->resolve();
    }
}
