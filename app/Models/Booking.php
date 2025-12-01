<?php

namespace App\Models;

use App\Core\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (user_id, car_id, mode, value, total_cost) 
                VALUES (:user_id, :car_id, :mode, :value, :total_cost)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function findByUserId($userId)
    {
        $sql = "SELECT b.*, c.name as car_name, c.pic as car_pic 
                FROM {$this->table} b 
                JOIN cars c ON b.car_id = c._id 
                WHERE b.user_id = :user_id 
                ORDER BY b.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }
    
    public function findAllWithDetails() {
         $sql = "SELECT b.*, c.name as car_name, u.username 
                FROM {$this->table} b 
                JOIN cars c ON b.car_id = c._id 
                JOIN user u ON b.user_id = u._id
                ORDER BY b.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
