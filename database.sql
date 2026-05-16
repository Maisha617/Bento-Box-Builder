-- Create database
CREATE DATABASE IF NOT EXISTS bento_box;
USE bento_box;

-- Create users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create bento_boxes table
CREATE TABLE bento_boxes (
    box_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    box_name VARCHAR(100),
    main_item VARCHAR(100),
    side_item VARCHAR(100),
    drink_item VARCHAR(100),
    sauce_item VARCHAR(100),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Create food_items table 
CREATE TABLE food_items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    category VARCHAR(50)
);

-- Insert food items
INSERT INTO food_items (name, category) VALUES
('Teriyaki Chicken', 'Main'),
('Tandoori Chicken', 'Main'),
('Beef Bulgogi', 'Main'),
('Thai Basil Tofu', 'Main'),
('Chipotle Lime Chicken', 'Main'),
('Garlic Ginger Salmon', 'Main'),

('Edamame', 'Side'),
('Kimchi', 'Side'),
('Fried Plantains', 'Side'),
('Cucumber Sunomono', 'Side'),
('Pita Chips & Hummus', 'Side'),
('Papaya Slaw', 'Side'),

('Mango Matcha Latte', 'Drink'),
('Brown Sugar Boba', 'Drink'),
('Thai Tea', 'Drink'),
('Mango Lassi', 'Drink'),
('Lychee Sparkling Water', 'Drink'),
('Iced Chai', 'Drink'),

('Spicy Mayo', 'Sauce'),
('Chimichurri Sauce', 'Sauce'),
('Tzatziki Sauce', 'Sauce'),
('Soy Sauce', 'Sauce'),
('Sweet Chili Sauce', 'Sauce'),
('Cilantro Lime Sauce', 'Sauce');

-- Grant permissions
GRANT ALL PRIVILEGES ON bento_box.* TO 'root'@'localhost';