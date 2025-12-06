<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\CarController;
use App\Controllers\BookingController;
use App\Controllers\AdminController;

/** @var \App\Core\Router $router */

$router->get('/', [HomeController::class, 'index']);

// Auth
$router->get('/login', [AuthController::class, 'loginForm']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/register', [AuthController::class, 'registerForm']);
$router->post('/register', [AuthController::class, 'register']);
$router->get('/logout', [AuthController::class, 'logout']);

// Cars
$router->get('/cars', [CarController::class, 'index']);
$router->get('/cars/show', [CarController::class, 'show']); // /cars/show?id=1

// Bookings
$router->get('/rent', [BookingController::class, 'create']); // /rent?car_id=1
$router->post('/rent', [BookingController::class, 'store']);
$router->get('/my-rentals', [BookingController::class, 'index']);
$router->get('/api/bookings/range', [BookingController::class, 'apiGetBookings']); // AJAX for calendar

// Admin
$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/cars', [AdminController::class, 'cars']);
$router->get('/admin/cars/create', [AdminController::class, 'createCar']);
$router->post('/admin/cars/store', [AdminController::class, 'storeCar']);
$router->get('/admin/cars/edit', [AdminController::class, 'editCar']); // ?id=1
$router->post('/admin/cars/update', [AdminController::class, 'updateCar']);
$router->post('/admin/cars/delete', [AdminController::class, 'deleteCar']);
$router->get('/admin/users', [AdminController::class, 'users']);
$router->post('/admin/users/delete', [AdminController::class, 'deleteUser']);
$router->get('/admin/bookings', [AdminController::class, 'bookings']);
$router->post('/admin/bookings/delete', [AdminController::class, 'deleteBooking']);
