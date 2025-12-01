<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\CarService;

class CarController extends Controller
{
    private $carService;

    public function __construct()
    {
        $this->carService = new CarService();
    }

    public function index()
    {
        $cars = $this->carService->getAllCars();
        $this->view('cars/index', ['cars' => $cars]);
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/cars');
        }

        $car = $this->carService->getCar($id);
        $this->view('cars/show', ['car' => $car]);
    }
}
