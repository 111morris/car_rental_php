<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->authService->login($username, $password)) {
            $this->redirect('/');
        } else {
            $this->view('auth/login', ['error' => 'Invalid credentials']);
        }
    }

    public function registerForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        // Basic validation could be added here
        if ($this->authService->register($_POST)) {
            $this->redirect('/login');
        } else {
            $this->view('auth/register', ['error' => 'Registration failed']);
        }
    }

    public function logout()
    {
        $this->authService->logout();
        $this->redirect('/');
    }
}
