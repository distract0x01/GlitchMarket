-- Creating and Using the Database
CREATE DATABASE IF NOT EXISTS glitchmarket;
USE glitchmarket;

-- Creating a some tables with it's columns, data types and constraints
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'customer',
    balance DECIMAL(10, 2) DEFAULT 500.00
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    username VARCHAR(50),
    comment TEXT
);

-- Seed Data (Weak passwords for brute-force/cracking)
INSERT INTO users (username, password, role, balance) VALUES
('admin', 'admin123', 'admin', 99999.99),
('Ahmed', 'ahmed123', 'customer', 1200.00),
('Hanaa', 'hanaa123', 'customer', 3500.00);

INSERT INTO products (name, description, price) VALUES
('RTX 5090 Founders Glitch Edition', '24GB GDDR7 VRAM with slightly overclocked factory firmware.', 1999.99),
('Flipper Zero Clone', 'Multi-tool device for pentesters and hardware geeks.', 169.00),
('Mechanical Keyboard 60%', 'Hot-swappable switches with custom RGB firmware.', 120.50);