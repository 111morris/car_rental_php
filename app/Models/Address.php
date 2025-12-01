<?php

namespace App\Models;

use App\Core\Model;

class Address extends Model
{
    protected $table = 'address';

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (street, city, state, country, zip) 
                VALUES (:street, :city, :state, :country, :zip)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }
}
