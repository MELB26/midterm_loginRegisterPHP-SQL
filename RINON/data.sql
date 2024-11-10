CREATE TABLE casino (
    casino_cat_id INT AUTO_INCREMENT PRIMARY KEY,
    casino_cat VARCHAR(50)
);

CREATE TABLE casino_details (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(50),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    Branch VARCHAR(50),
    casino_cat_id INT,
);

CREATE TABLE user_passwords (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP,
    casino_cat_id INT,
);
