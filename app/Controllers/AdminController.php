<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Services\CarService;
use App\Services\BookingService;

class AdminController extends Controller
{
    public function __construct()
    {
        if (!Session::isAdmin()) {
            $this->redirect('/');
        }
    }

    public function dashboard()
    {
        $this->view('admin/dashboard');
    }

    public function cars()
    {
        $carService = new CarService();
        $cars = $carService->getAllCars();
        $this->view('admin/cars', ['cars' => $cars]);
    }

    public function users()
    {
        $userService = new \App\Services\UserService();
        $users = $userService->getAllUsers();
        $this->view('admin/users', ['users' => $users]);
    }

    public function deleteUser()
    {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $userService = new \App\Services\UserService();
            $userService->deleteUser($id);
        }
        $this->redirect('/admin/users');
    }

    public function createCar()
    {
        $this->view('admin/cars_create');
    }

    public function storeCar()
    {
        $carService = new CarService();
        if ($carService->createCar($_POST)) {
            $this->redirect('/admin/cars');
        } else {
            // Handle error
            $this->redirect('/admin/cars/create');
        }
    }

    public function editCar()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/cars');
        }
        
        $carService = new CarService();
        $car = $carService->getCar($id);
        
        $this->view('admin/cars_edit', ['car' => $car]);
    }

    public function updateCar()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->redirect('/admin/cars');
        }

        $carService = new CarService();
        if ($carService->updateCar($id, $_POST)) {
            $this->redirect('/admin/cars');
        } else {
            // Handle error
            $this->redirect("/admin/cars/edit?id=$id");
        }
    }

    public function deleteCar()
    {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $carService = new CarService();
            $carService->deleteCar($id);
        }
        $this->redirect('/admin/cars');
    }
    public function bookings()
    {
        $bookingService = new BookingService();
        $bookings = $bookingService->getAllBookings();
        $this->view('admin/bookings', ['bookings' => $bookings]);
    }

    public function deleteBooking()
    {
        // For simplicity, we are not adding delete logic in Service yet, 
        // assuming admin just wants to view for now based on prompt, 
        // but prompt asked for modify. 
        // Let's implement delete via model direct or service.
        // The service has no delete method yet.
        // Let's add it to service first or just use model here for speed if acceptable, 
        // but better to stick to Service pattern.
        // I will add deleteBooking to BookingService in next step or assume it exists.
        // Actually, I'll add the method to AdminController but it will fail if Service is missing it.
        // Step 1: Update Controller
        
        $id = $_POST['id'] ?? null;
        if ($id) {
             // Assuming I will add this to Service
            $bookingService = new BookingService();
            $bookingService->deleteBooking($id);
        }
        $this->redirect('/admin/bookings');
    }
}
