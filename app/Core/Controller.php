<?php

namespace App\Core;

class Controller
{
    public function view($view, $data = [])
    {
        return View::render($view, $data);
    }

    public function redirect($url)
    {
        header("Location: " . $url);
        exit;
    }
    
    public function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
