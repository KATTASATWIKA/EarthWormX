<?php
// database_connection.php
// This file handles the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm_system";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create users table if not exists
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('farmer', 'customer') NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(15),
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Create products table if not exists
$sql = "CREATE TABLE IF NOT EXISTS products (
    product_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category ENUM('Seeds', 'Ploughing', 'Irrigation', 'Fertilizer', 'Harvesting') NOT NULL,
    purchase_price DECIMAL(10, 2) NULL,
    rental_price DECIMAL(10, 2) NULL,
    rental_unit VARCHAR(20) NULL COMMENT 'day, month, etc.',
    image_url VARCHAR(255),
    stock INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating products table: " . $conn->error);
}

// Create orders table if not exists
$sql = "CREATE TABLE IF NOT EXISTS orders (
    order_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) UNSIGNED NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled') DEFAULT 'Pending',
    payment_method VARCHAR(50),
    order_source VARCHAR(50) NOT NULL COMMENT 'Seeds, Ploughing, Irrigation, Fertilizer, Harvesting',
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating orders table: " . $conn->error);
}

// Create order_items table if not exists
$sql = "CREATE TABLE IF NOT EXISTS order_items (
    item_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id INT(6) UNSIGNED NOT NULL,
    product_id INT(6) UNSIGNED NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price DECIMAL(10, 2) NOT NULL,
    transaction_type ENUM('Purchase', 'Rental') DEFAULT 'Purchase',
    rental_duration VARCHAR(50) NULL COMMENT 'Only for rental items',
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
)";

if ($conn->query($sql) !== TRUE) {
    die("Error creating order_items table: " . $conn->error);
}
?>