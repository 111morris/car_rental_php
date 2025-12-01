<?php

namespace App\Models;

use App\Core\Model;

class Car extends Model
{
    protected $table = 'cars';

    public function findAllWithRates()
    {
        $sql = "SELECT c.*, r.rate_by_hour, r.rate_by_day, r.rate_by_km 
                FROM {$this->table} c 
                LEFT JOIN car_rates r ON c._id = r.car_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findByIdWithRates($id)
    {
        $sql = "SELECT c.*, r.rate_by_hour, r.rate_by_day, r.rate_by_km 
                FROM {$this->table} c 
                LEFT JOIN car_rates r ON c._id = r.car_id 
                WHERE c._id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function updateStock($id, $change) {
        $sql = "UPDATE {$this->table} SET stock = stock + :change WHERE _id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['change' => $change, 'id' => $id]);
    }
}
