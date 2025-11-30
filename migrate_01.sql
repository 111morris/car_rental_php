-- =============================
-- Car Rental Database Migration
-- =============================
-- Use your database
USE carjack;
-- -----------------------------
-- TABLES
-- -----------------------------
CREATE TABLE IF NOT EXISTS address (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    street VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    zip INT NOT NULL
);
CREATE TABLE IF NOT EXISTS user (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    ph_no VARCHAR(10),
    gender ENUM('m', 'f', 'u') DEFAULT 'u',
    join_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    address_id INT,
    avatar VARCHAR(500) DEFAULT 'https://ssl.gstatic.com/images/branding/product/1x/avatar_circle_blue_512dp.png',
    CONSTRAINT user_address_id_fk FOREIGN KEY (address_id) REFERENCES address(_id) ON DELETE
    SET NULL ON UPDATE CASCADE
);
-- Drop and create indexes safely
-- DROP INDEX IF EXISTS user_email_uindex ON user;
-- CREATE UNIQUE INDEX user_email_uindex ON user(email);
-- DROP INDEX IF EXISTS user_username_uindex ON user;
-- CREATE UNIQUE INDEX user_username_uindex ON user(username);
CREATE TABLE IF NOT EXISTS admins (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    CONSTRAINT admins_user_id_fk FOREIGN KEY (user_id) REFERENCES user(_id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS cars (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    pic VARCHAR(200),
    info TEXT,
    stock INT NOT NULL
);
CREATE TABLE IF NOT EXISTS car_rates (
    car_id INT NOT NULL,
    rate_by_hour INT NOT NULL DEFAULT 100,
    rate_by_day INT NOT NULL DEFAULT 2000,
    rate_by_km INT NOT NULL DEFAULT 20,
    CONSTRAINT car_rates_car_id_fk FOREIGN KEY (car_id) REFERENCES cars(_id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS transaction (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    mode ENUM('km', 'day', 'hour') NOT NULL,
    value INT NOT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT transaction_user_id_fk FOREIGN KEY (user_id) REFERENCES user(_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT transaction_car_id_fk FOREIGN KEY (car_id) REFERENCES cars(_id) ON DELETE CASCADE ON UPDATE CASCADE
);
-- -----------------------------
-- TRIGGERS
-- -----------------------------
-- DROP TRIGGER IF EXISTS STOCK_UPDATE_DECREASE;
-- DROP TRIGGER IF EXISTS STOCK_UPDATE_INCREASE;
-- DELIMITER $$ CREATE TRIGGER STOCK_UPDATE_DECREASE
-- AFTER
-- INSERT ON transaction FOR EACH ROW BEGIN
-- UPDATE cars
-- SET stock = stock - 1
-- WHERE _id = NEW.car_id;
-- END $$ CREATE TRIGGER STOCK_UPDATE_INCREASE
-- AFTER DELETE ON transaction FOR EACH ROW BEGIN
-- UPDATE cars
-- SET stock = stock + 1
-- WHERE _id = OLD.car_id;
-- END $$ DELIMITER;
-- -----------------------------
-- SEED DATA
-- -----------------------------
-- Address
INSERT INTO address (street, city, state, country, zip)
SELECT '22B-Bakers Street',
    'London',
    'London',
    'England',
    0
WHERE NOT EXISTS (
        SELECT 1
        FROM address
        WHERE street = '22B-Bakers Street'
    );
-- Admin user
INSERT INTO user (
        first_name,
        last_name,
        email,
        username,
        password,
        ph_no,
        gender,
        join_time,
        address_id,
        avatar
    )
SELECT 'Admin',
    'Account',
    'admin@io.io',
    'admin',
    '$2y$10$UPAMoof5OI7TrzXoTlvkMuLn9OVhQCgTOyXb4j5wStUXqzyGJ0UFa',
    '',
    'u',
    '2017-12-22 13:02:04',
    1,
    'https://ssl.gstatic.com/images/branding/product/1x/avatar_circle_blue_512dp.png'
WHERE NOT EXISTS (
        SELECT 1
        FROM user
        WHERE username = 'admin'
    );
-- Admins table
INSERT INTO admins (user_id)
SELECT 1
WHERE NOT EXISTS (
        SELECT 1
        FROM admins
        WHERE user_id = 1
    );
-- Cars
INSERT INTO cars (name, pic, info, stock)
SELECT 'Ford Mustang',
    'https://www.carmax.com/~/media/images/carmax/com/Articles/10-best-sports-cars-for-2017/178392-01-ford-mustang.png?la=en&hash=24DFF4EF3A020F5E11569427B8A8C9BE0DAF208C',
    'The current Mustang arrived in 2015, and brought with it a new range of engine choices. The 3.7L V6 became the base engine; it''s good for a not-at-all-shabby 300 horsepower. Next up is a 2.3L, turbocharged four-cylinder that makes 310 horsepower. Yes, only four cylinders, but it sprints from zero to 60 in less than six seconds! Topping the range is a 5.0L V8 good for over 400 horsepower. Transmission choices include a six-speed manual or an automatic with paddle shifters.',
    13
WHERE NOT EXISTS (
        SELECT 1
        FROM cars
        WHERE name = 'Ford Mustang'
    );
-- Additional cars and car_rates inserts can follow here with similar safe existence checks