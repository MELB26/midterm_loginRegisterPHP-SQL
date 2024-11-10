CREATE TABLE casino (
    casino_cat_id INT AUTO_INCREMENT PRIMARY KEY,
    casino_cat VARCHAR(50)
);

CREATE TABLE casino_details (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(50),
    date_added date,
    Branch VARCHAR(50),
    casino_cat_id INT,
);