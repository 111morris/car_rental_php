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

    public function createBooking($userId, $carId, $mode, $value, $startDateStr)
    {
        $car = $this->carModel->findByIdWithRates($carId);
        
        if (!$car || $car['stock'] <= 0) {
            return false; // Car not available
        }
        
        // Calculate dates
        $startDate = new \DateTime($startDateStr);
        $endDate = clone $startDate;
        
        if ($mode === 'day') {
            $endDate->modify("+$value days");
        } elseif ($mode === 'hour') {
            $endDate->modify("+$value hours");
        } else {
            // Memory estimation for KM, assuming 1 hour minimum for calendar blocking
             $endDate->modify("+1 hour");
        }

        $formattedStart = $startDate->format('Y-m-d H:i:s');
        $formattedEnd = $endDate->format('Y-m-d H:i:s');

        // Check availability
        if (count($this->bookingModel->findConflictingBookings($carId, $formattedStart, $formattedEnd)) > 0) {
            return false; // Dates overlap
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
            'total_cost' => $cost,
            'start_date' => $formattedStart,
            'end_date' => $formattedEnd
        ];

        if ($this->bookingModel->create($bookingData)) {
            // Decrease stock
            $this->carModel->updateStock($carId, -1);
            return true;
        }

        return false;
    }
    
    

}
