<?php

namespace App\Core;

class View
{
    public static function render($viewPath, $data = [])
    {
        extract($data);

        $viewFile = __DIR__ . '/../../views/' . $viewPath . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View file not found: $viewFile");
        }
    }
}
