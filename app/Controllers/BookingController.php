<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Services\BookingService;
use App\Services\CarService;

class BookingController extends Controller
{
    private $bookingService;
    private $carService;

    public function __construct()
    {
        $this->bookingService = new BookingService();
        $this->carService = new CarService();
    }

    public function create()
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/login');
        }

        $carId = $_GET['car_id'] ?? null;
        if (!$carId) {
            $this->redirect('/cars');
        }

        $car = $this->carService->getCar($carId);
        $this->view('bookings/create', ['car' => $car]);
    }

    public function store()
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/login');
        }

        $userId = Session::get('user_id');
        $carId = $_POST['car_id'];
        $mode = $_POST['mode'];
        $value = $_POST['value'];

        if ($this->bookingService->createBooking($userId, $carId, $mode, $value)) {
            $this->redirect('/my-rentals');
        } else {
            $this->view('bookings/create', ['error' => 'Booking failed', 'car' => $this->carService->getCar($carId)]);
        }
    }

    public function index()
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/login');
        }

        $userId = Session::get('user_id');
        $rentals = $this->bookingService->getUserRentals($userId);
        $this->view('bookings/index', ['rentals' => $rentals]);
    }
}
