-- Use the database
USE amatrade_store;

-- Create the basket table
CREATE TABLE IF NOT EXISTS basket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item_name VARCHAR(255) NOT NULL,
    item_price DECIMAL(10, 2) NOT NULL,
    location VARCHAR(255) NOT NULL,
    shop VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('processing', 'cancelled', 'done') DEFAULT 'processing',
    approved_by_user BOOLEAN DEFAULT 0, -- Add this column for user approval status
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Use the database
USE amatrade_store;

-- Alter the basket table
ALTER TABLE basket
ADD COLUMN location_price DECIMAL(10, 2) NOT NULL DEFAULT 0.00;
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_date DATE NOT NULL,
    amount DECIMAL(10, 2) NOT NULL
    -- Add more columns as needed
);

ALTER TABLE basket
CHANGE COLUMN `timestamp` `added_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;


CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10, 2),
    delivery_price DECIMAL(10, 2),
    status VARCHAR(255),
    -- Add other necessary columns
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


