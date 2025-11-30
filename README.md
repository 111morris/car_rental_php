# Car Rental PHP Project

````markdown

A simple car rental management system built with PHP and MySQL. This project allows users to view and rent cars, and provides an admin panel for managing cars, rates, and users.

---

Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Running the Project](#running-the-project)
- [Project Structure](#project-structure)
- [Admin User](#admin-user)
- [Notes](#notes)

---

Prerequisites

Make sure you have the following installed on your system:

1. **PHP 8+**  
   Check with:  
   ```bash
   php -v
   
````

2. **MySQL 8+**
   Check with:

   ```bash
   mysql --version
   ```

3. **Composer (Optional)** if using external PHP packages:

   ```bash
   composer --version
   ```

4. **Git** (Optional, for cloning the repository):

   ```bash
   git --version
   ```

---

## Installation

1. Clone the repository:

```bash
git clone <your-repo-url>
cd car-rental-php
```

2. Make sure the `public` folder contains the `index.php` file. This is your project entry point.

---

## Database Setup

### 1. Log in to MySQL as an admin user

If you haven’t created the project database user yet, you can log in as `root` or `mysql` superuser:

```bash
sudo mysql -u root -p
```

### 2. Create the database and user

```sql
-- Create the database
CREATE DATABASE carjack;

-- Create the project user (change password as needed)
CREATE USER 'carjack_admin'@'localhost' IDENTIFIED BY 'wazebra';

-- Give privileges to the user
GRANT ALL PRIVILEGES ON carjack.* TO 'carjack_admin'@'localhost';

-- Apply privileges
FLUSH PRIVILEGES;
```

### 3. Import database schema and seed data

#### a) Clear existing database (optional, if re-running)

```bash
mysql -u carjack_admin -p
```

Then inside MySQL:

```sql
DROP DATABASE IF EXISTS carjack;
CREATE DATABASE carjack;
EXIT;
```

#### b) Run migrations

```bash
# Step 1: Create tables and triggers
mysql -u carjack_admin -p carjack < migrate_00.sql

# Step 2: Insert initial data
mysql -u carjack_admin -p carjack < migrate_01.sql
```

You can verify:

```bash
mysql -u carjack_admin -p carjack
SHOW TABLES;
SELECT * FROM user;
SELECT * FROM cars;
```

---

## Running the Project

Start the built-in PHP development server from the project root:

```bash
php -S localhost:8000 -t public
```

* Open your browser and visit: [http://localhost:8000](http://localhost:8000)
* You should see the project running.

---

## Project Structure

```
car-rental-php/
│
├── classes/          # PHP classes for DB, pages, services
├── public/           # Entry point (index.php)
├── migrate_00.sql    # Database schema (tables + triggers)
├── migrate_01.sql    # Initial data (users, cars, rates)
├── Database.php      # Database connection class
├── README.md         # Project documentation
```

---

## Admin User

* Default admin credentials (from `migrate_01.sql`):

| Field    | Value                                       |
| -------- | ------------------------------------------- |
| Username | admin                                       |
| Email    | [admin@io.io](mailto:admin@io.io)           |
| Password | The hashed password from migration (bcrypt) |

> You can log in as this admin user to manage the system.

---

## Notes

* Ensure MySQL is running before starting the PHP server.
* If you see errors like `Call to a member function prepare() on null`, it usually means the database connection failed.
* Always run `migrate_00.sql` first, then `migrate_01.sql`.
* If you want to reset the database, drop the `carjack` database and re-run migrations.

---

```markdown

If you want, I can also **add a "full automated setup" section** where a user could run **all commands in one go**, including creating the database, user, schema, and seed data—so they just copy-paste a few commands and everything works.  

Do you want me to add that?
```
