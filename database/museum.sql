CREATE DATABASE IF NOT EXISTS museum_db;

USE museum_db;

CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    number_of_visitors INT NOT NULL,
    visit_date DATE NOT NULL,
    visit_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
