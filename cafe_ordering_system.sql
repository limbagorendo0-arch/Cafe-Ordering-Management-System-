-- --------------------------------------------------------
-- Café Ordering Management System - SQL Database Script
-- --------------------------------------------------------
-- Instructions:
-- 1. Open your MySQL tool (e.g., phpMyAdmin, MySQL Workbench, XAMPP).
-- 2. Create a new database (e.g., cafe_system).
-- 3. Import this SQL file into that database.
-- --------------------------------------------------------

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role ENUM('admin', 'cashier')
);

-- Table: categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

-- Table: meals
CREATE TABLE meals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    image VARCHAR(255)
    status ENUM('available', 'occupied') NOT NULL DEFAULT 'available'
    image_url VARCHAR(255) NULL
);

-- Table: tables
CREATE TABLE tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_number INT,
    status ENUM('available', 'occupied'),
    table_name VARCHAR(100)
);

-- Table: orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_id INT,
    user_id INT,
    total DECIMAL(10,2),
    order_type ENUM('dine-in', 'take-out'),
    status ENUM('pending', 'completed'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (table_id) REFERENCES tables(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: order_items
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    meal_id INT,
    quantity INT,
    subtotal DECIMAL(10,2),
     price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (meal_id) REFERENCES meals(id)
);
