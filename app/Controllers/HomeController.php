<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CarService;

class HomeController extends Controller
{
    public function index()
    {
        $carService = new CarService();
        $cars = $carService->getAllCars();
        
        // Show only top 3 cars for homepage
        $featuredCars = array_slice($cars, 0, 3);
        
        $this->view('home/index', ['cars' => $featuredCars]);
    }
}
