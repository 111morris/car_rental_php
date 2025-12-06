<?php

namespace App\Services;

use App\Models\Car;

class CarService
{
    private $carModel;

    public function __construct()
    {
        $this->carModel = new Car();
    }

    public function getAllCars()
    {
        return $this->carModel->findAllWithRates();
    }

    public function getCar($id)
    {
        return $this->carModel->findByIdWithRates($id);
    }

    public function createCar($data)
    {
        // 1. Create Car
        $carData = [
            'name' => $data['name'],
            'pic' => $data['pic'],
            'info' => $data['info'],
            'stock' => $data['stock'],
            'seats' => $data['seats'],
            'transmission' => $data['transmission']
        ];
        
        $sql = "INSERT INTO cars (name, pic, info, stock, seats, transmission) VALUES (:name, :pic, :info, :stock, :seats, :transmission)";
        $stmt = \App\Config\Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute($carData);
        $carId = \App\Config\Database::getInstance()->getConnection()->lastInsertId();

        // 2. Create Rates
        $ratesData = [
            'car_id' => $carId,
            'rate_by_hour' => $data['rate_by_hour'],
            'rate_by_day' => $data['rate_by_day'],
            'rate_by_km' => $data['rate_by_km']
        ];
        
        $sqlRates = "INSERT INTO car_rates (car_id, rate_by_hour, rate_by_day, rate_by_km) 
                     VALUES (:car_id, :rate_by_hour, :rate_by_day, :rate_by_km)";
        $stmtRates = \App\Config\Database::getInstance()->getConnection()->prepare($sqlRates);
        return $stmtRates->execute($ratesData);
    }

    public function updateCar($id, $data)
    {
        // 1. Update Car
        $sql = "UPDATE cars SET name = :name, pic = :pic, info = :info, stock = :stock, seats = :seats, transmission = :transmission WHERE _id = :id";
        $stmt = \App\Config\Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'pic' => $data['pic'],
            'info' => $data['info'],
            'stock' => $data['stock'],
            'seats' => $data['seats'],
            'transmission' => $data['transmission'],
            'id' => $id
        ]);

        // 2. Update Rates
        $sqlRates = "UPDATE car_rates SET rate_by_hour = :rate_by_hour, rate_by_day = :rate_by_day, rate_by_km = :rate_by_km 
                     WHERE car_id = :id";
        $stmtRates = \App\Config\Database::getInstance()->getConnection()->prepare($sqlRates);
        return $stmtRates->execute([
            'rate_by_hour' => $data['rate_by_hour'],
            'rate_by_day' => $data['rate_by_day'],
            'rate_by_km' => $data['rate_by_km'],
            'id' => $id
        ]);
    }

    public function deleteCar($id)
    {
        return $this->carModel->delete($id);
    }
}
