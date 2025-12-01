<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Car;

class BookingService
{
    private $bookingModel;
    private $carModel;

    public function __construct()
    {
        $this->bookingModel = new Booking();
        $this->carModel = new Car();
    }

    public function createBooking($userId, $carId, $mode, $value)
    {
        $car = $this->carModel->findByIdWithRates($carId);
        
        if (!$car || $car['stock'] <= 0) {
            return false; // Car not available
        }

        // Calculate cost
        $cost = 0;
        if ($mode === 'hour') {
            $cost = $car['rate_by_hour'] * $value;
        } elseif ($mode === 'day') {
            $cost = $car['rate_by_day'] * $value;
        } elseif ($mode === 'km') {
            $cost = $car['rate_by_km'] * $value;
        }

        $bookingData = [
            'user_id' => $userId,
            'car_id' => $carId,
            'mode' => $mode,
            'value' => $value,
            'total_cost' => $cost
        ];

        if ($this->bookingModel->create($bookingData)) {
            // Decrease stock
            $this->carModel->updateStock($carId, -1);
            return true;
        }

        return false;
    }

    public function getUserRentals($userId)
    {
        return $this->bookingModel->findByUserId($userId);
    }
    
    public function getAllBookings() {
        return $this->bookingModel->findAllWithDetails();
    }
}
