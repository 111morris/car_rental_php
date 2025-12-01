<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarJack - Car Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 56px; }
        .hero { background: #f8f9fa; padding: 4rem 2rem; text-align: center; }
        .car-card img { height: 200px; object-fit: cover; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">CarJack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/cars">Cars</a></li>
                <?php if (\App\Core\Session::isLoggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="/my-rentals">My Rentals</a></li>
                    <?php if (\App\Core\Session::isAdmin()): ?>
                        <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
