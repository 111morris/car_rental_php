<?php

namespace App\Services;

use App\Models\User;
use App\Models\Address;
use App\Core\Session;

class AuthService
{
    private $userModel;
    private $addressModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->addressModel = new Address();
    }

    public function login($username, $password)
    {
        $user = $this->userModel->findByUsername($username);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            Session::set('user_id', $user['_id']);
            Session::set('username', $user['username']);
            
            if ($this->userModel->isAdmin($user['_id'])) {
                Session::set('is_admin', true);
            }
            
            return true;
        }

        return false;
    }

    public function register($data)
    {
        // 1. Create Address
        $addressId = $this->addressModel->create([
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'zip' => $data['zip']
        ]);

        // 2. Create User
        $userData = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'ph_no' => $data['ph_no'],
            'gender' => $data['gender'],
            'address_id' => $addressId
        ];

        return $this->userModel->create($userData);
    }

    public function logout()
    {
        Session::destroy();
    }
}
