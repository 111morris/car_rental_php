<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function getAllUsers()
    {
        return $this->userModel->findAll();
    }

    public function getUser($id)
    {
        return $this->userModel->findById($id);
    }

    public function deleteUser($id)
    {
        // Prevent deleting the main admin if needed, but for now just delete
        // Maybe check if it's the current user?
        return $this->userModel->delete($id);
    }
}
