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
        $startDate = $_POST['start_date'];

        if ($this->bookingService->createBooking($userId, $carId, $mode, $value, $startDate)) {
            $this->redirect('/my-rentals');
        } else {
            $this->view('bookings/create', [
                'error' => 'Booking failed: Car unavailable for selected dates or system error.',
                'car' => $this->carService->getCar($carId)
            ]);
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
    
    public function apiGetBookings() {
        $carId = $_GET['car_id'] ?? null;
        if(!$carId) {
            echo json_encode([]);
            return;
        }
        
        $bookings = $this->bookingService->getBlockedDates($carId);
        $events = [];
        foreach($bookings as $booking) {
            $events[] = [
                'title' => 'Booked',
                'start' => $booking['start_date'],
                'end' => $booking['end_date'],
                'color' => '#ff0000'
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($events);
        exit;
    }
}
