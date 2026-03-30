CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL,
    password VARCHAR(255)
);

CREATE TABLE countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    number_of_stars INT NOT NULL,
    image MEDIUMBLOB,
    country_id INT,
    FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    image MEDIUMBLOB,
    number_of_bed INT,
    number_of_bath INT,
    price_per_night INT,
    hotel_id INT,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id)
);

CREATE TABLE places (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    image MEDIUMBLOB,
    country_id INT,
    FOREIGN KEY (country_id) REFERENCES countries(id)
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100),
    user_email VARCHAR(100),
    user_phone VARCHAR(20),
    check_in DATE,
    check_out DATE,
    rent_car BOOLEAN,
    rental_start DATE,
    rental_end DATE,
    with_driver BOOLEAN,
    airport_pickup BOOLEAN,
    airport_arrival_time VARCHAR(50),
    car_name VARCHAR(50),
    status VARCHAR(50) DEFAULT 'pending',
    room_id INT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (room_id) REFERENCES rooms(id)
);
