<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'user';

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
    
    public function findByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (first_name, last_name, email, username, password, ph_no, gender, address_id) 
                VALUES (:first_name, :last_name, :email, :username, :password, :ph_no, :gender, :address_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function isAdmin($userId) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch() !== false;
    }
}
