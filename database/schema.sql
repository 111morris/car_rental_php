-- =============================
-- Car Rental Database Schema
-- =============================

DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS car_rates;
DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS address;

-- -----------------------------
-- TABLES
-- -----------------------------

CREATE TABLE address (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    street VARCHAR(100) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    zip INT NOT NULL
);

CREATE TABLE user (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    ph_no VARCHAR(15),
    gender ENUM('m', 'f', 'u') DEFAULT 'u',
    join_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    address_id INT,
    avatar VARCHAR(500) DEFAULT 'https://ssl.gstatic.com/images/branding/product/1x/avatar_circle_blue_512dp.png',
    CONSTRAINT user_address_id_fk FOREIGN KEY (address_id) REFERENCES address(_id) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE admins (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    CONSTRAINT admins_user_id_fk FOREIGN KEY (user_id) REFERENCES user(_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE cars (
    _id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    pic TEXT,
    info TEXT,
    stock INT NOT NULL DEFAULT 0
);

CREATE TABLE car_rates (
    car_id INT NOT NULL,
    rate_by_hour INT NOT NULL DEFAULT 100,
    rate_by_day INT NOT NULL DEFAULT 2000,
    rate_by_km INT NOT NULL DEFAULT 20,
    PRIMARY KEY (car_id),
    CONSTRAINT car_rates_car_id_fk FOREIGN KEY (car_id) REFERENCES cars(_id) ON DELETE CASCADE ON UPDATE CASCADE
);



-- -----------------------------
-- SEED DATA
-- -----------------------------

INSERT INTO address (street, city, state, country, zip) VALUES 
('22B-Bakers Street', 'London', 'London', 'England', 0);

-- Password is 'password' hashed
INSERT INTO user (first_name, last_name, email, username, password, ph_no, gender, address_id) VALUES 
('Admin', 'Account', 'admin@io.io', 'admin', '$2y$10$UPAMoof5OI7TrzXoTlvkMuLn9OVhQCgTOyXb4j5wStUXqzyGJ0UFa', '1234567890', 'u', 1);

INSERT INTO admins (user_id) VALUES (1);

INSERT INTO cars (name, pic, info, stock) VALUES 
('Ford Mustang', 'https://upload.wikimedia.org/wikipedia/commons/6/6c/2019_Ford_Mustang_GT_Blue.jpg', 'The current Mustang arrived in 2015', 13),
('Chevrolet Camaro', 'https://upload.wikimedia.org/wikipedia/commons/5/5e/2019_Chevrolet_Camaro_2SS_6.2L_front_3.16.19.jpg', 'The Chevrolet Camaro is a mid-size American automobile...', 5),
('Tesla Model S', 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/2018_Tesla_Model_S_75D.jpg/1200px-2018_Tesla_Model_S_75D.jpg', 'The Tesla Model S is an all-electric five-door liftback sedan.', 8),
('BMW M4', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/BMW_M4_COUPE_%28F82%29_China.jpg/640px-BMW_M4_COUPE_%28F82%29_China.jpg', 'The BMW M4 is a high-performance version of the BMW 4 Series.', 3),
('Audi R8', 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/2018_Audi_R8_Coupe_V10_plus_Front.jpg/640px-2018_Audi_R8_Coupe_V10_plus_Front.jpg', 'The Audi R8 is a mid-engine, 2-seater sports car.', 2),
('Mercedes-Benz C-Class', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/M%C3%BCnster%2C_Beresa%2C_Mercedes-Benz_C-Klasse_Cabrio_--_2018_--_1757.jpg/640px-M%C3%BCnster%2C_Beresa%2C_Mercedes-Benz_C-Klasse_Cabrio_--_2018_--_1757.jpg', 'The Mercedes-Benz C-Class is a line of compact executive cars.', 10);

INSERT INTO car_rates (car_id, rate_by_hour, rate_by_day, rate_by_km) VALUES 
(1, 100, 2000, 20),
(2, 120, 2200, 25),
(3, 150, 3000, 30),
(4, 180, 3500, 35),
(5, 250, 5000, 50),
(6, 130, 2500, 22);
