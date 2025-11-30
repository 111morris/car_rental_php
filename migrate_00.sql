-- Create tables if they do not exist
CREATE TABLE IF NOT EXISTS address
(
  _id INT PRIMARY KEY AUTO_INCREMENT,
  street VARCHAR(100) NOT NULL,
  city VARCHAR(100) NOT NULL,
  state VARCHAR(100) NOT NULL,
  country VARCHAR(100) NOT NULL,
  zip INT NOT NULL
);

CREATE TABLE IF NOT EXISTS user
(
  _id INT PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(255) NOT NULL,
  ph_no VARCHAR(10),
  gender ENUM('m', 'f', 'u') DEFAULT 'u',
  join_time TIMESTAMP DEFAULT NOW(),
  address_id INT,
  avatar VARCHAR(500) DEFAULT 'https://ssl.gstatic.com/images/branding/product/1x/avatar_circle_blue_512dp.png',
  CONSTRAINT user_address_id_fk FOREIGN KEY (address_id) REFERENCES address (_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create indexes safely
-- DROP INDEX user_email_uindex ON user;
-- CREATE UNIQUE INDEX user_email_uindex ON user(email);
-- DROP INDEX user_username_uindex ON user;
-- CREATE UNIQUE INDEX user_username_uindex ON user(username);

CREATE UNIQUE INDEX user_email_uindex ON user (email);
CREATE UNIQUE INDEX user_username_uindex ON user (username);


CREATE TABLE IF NOT EXISTS admins
(
  _id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  CONSTRAINT admins_user_id_fk FOREIGN KEY (user_id) REFERENCES user (_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS cars
(
  _id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  pic VARCHAR(200),
  info TEXT,
  stock INT NOT NULL
);

CREATE TABLE IF NOT EXISTS car_rates
(
  car_id INT NOT NULL,
  rate_by_hour INT NOT NULL DEFAULT 100,
  rate_by_day INT NOT NULL DEFAULT 2000,
  rate_by_km INT NOT NULL DEFAULT 20,
  CONSTRAINT car_rates_car_id_fk FOREIGN KEY (car_id) REFERENCES cars (_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS transaction
(
  _id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  mode ENUM('km', 'day', 'hour') NOT NULL,
  value INT NOT NULL,
  time TIMESTAMP NOT NULL DEFAULT NOW(),
  CONSTRAINT transaction_user_id_fk FOREIGN KEY (user_id) REFERENCES user (_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT transaction_car_id_fk FOREIGN KEY (car_id) REFERENCES cars (_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Drop triggers if they exist before creating
DROP TRIGGER IF EXISTS STOCK_UPDATE_DECREASE;
DROP TRIGGER IF EXISTS STOCK_UPDATE_INCREASE;

DELIMITER $$

CREATE TRIGGER STOCK_UPDATE_DECREASE
AFTER INSERT ON transaction
FOR EACH ROW
BEGIN
  UPDATE cars SET stock = stock - 1 WHERE _id = NEW.car_id;
END $$

CREATE TRIGGER STOCK_UPDATE_INCREASE
AFTER DELETE ON transaction
FOR EACH ROW
BEGIN
  UPDATE cars SET stock = stock + 1 WHERE _id = OLD.car_id;
END $$

DELIMITER ;
