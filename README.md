# CarJack - PHP Car Rental System

A modern, MVC-based Car Rental Website built with PHP 8, PDO, and Bootstrap 5. This project demonstrates clean architecture, secure authentication, and a complete booking flow.

## Features

- **MVC Architecture**: Clear separation of Models, Views, and Controllers.
- **Custom Routing**: Lightweight router handling GET and POST requests.
- **Authentication**: Secure login and registration with `password_hash`.
- **Booking System**: Rent cars by Hour, Day, or KM with automatic stock management.
- **Admin Panel**: Manage cars and view inventory.
- **Responsive Design**: Built with Bootstrap 5 for mobile-friendly layouts.
- **Security**: Uses PDO prepared statements to prevent SQL injection.

## Project Structure

```
app/
├── Config/         # Database configuration
├── Controllers/    # Request handlers (Auth, Car, Booking, Admin)
├── Core/           # Framework core (Router, Model, View, App)
├── Models/         # Data access layer
├── Services/       # Business logic
└── routes.php      # Route definitions

public/             # Web root
├── index.php       # Entry point
└── .htaccess       # URL rewriting

views/              # HTML Templates
├── auth/           # Login/Register views
├── bookings/       # Booking flow views
├── cars/           # Car listing views
├── home/           # Homepage
└── layouts/        # Header/Footer partials

database/
└── schema.sql      # Database schema and seed data
```

## Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache (or PHP built-in server)
- **OR** Docker and Docker Compose

## Installation

### Option 1: Docker (Recommended)

1.  **Clone the repository**
    ```bash
    git clone https://github.com/111morris/car_rental_php.git
    cd car_rental_php
    ```

2.  **Run with Docker Compose**
    ```bash
    docker-compose up -d
    ```
    This will start the PHP application on port `8080` and a MySQL database. The database will be automatically initialized with the schema and seed data.

3.  **Access the App**
    - Open `http://localhost:8080` in your browser.

### Option 2: Manual Setup

1.  **Clone the repository**
    ```bash
    git clone https://github.com/111morris/car_rental_php.git
    cd car_rental_php
    ```

2.  **Setup Database**
    - Create a MySQL database named `carjack`.
    - Import the schema and seed data:
    ```bash
    mysql -u root -p carjack < database/schema.sql
    ```
    *(Note: Update `app/Config/config.php` if your local database credentials differ from the defaults.)*

3.  **Run the Application**
    - **Using PHP Built-in Server**:
      ```bash
      cd public
      php -S localhost:8000
      ```
    - **Using Apache**:
      - Point your virtual host document root to the `public/` folder.
      - Ensure `mod_rewrite` is enabled.

4.  **Access the App**
    - Open `http://localhost:8000` in your browser.

## Default Credentials

**Admin User:**
- Username: `admin`
- Password: `password`

## Usage

1.  **Register/Login**: Create a new account or use the admin credentials.
2.  **Browse Cars**: View the fleet of available cars.
3.  **Rent a Car**: Select a car, choose a rental mode (Day/Hour/KM), and confirm.
4.  **My Rentals**: View your active and past rentals.
5.  **Admin Dashboard**: Log in as admin to manage the fleet.

## License

This project is open-source and available under the MIT License.
