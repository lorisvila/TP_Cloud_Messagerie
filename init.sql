CREATE DATABASE web;

USE web;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255)
);

CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id VARCHAR(255),
    receiver_id VARCHAR(255),
    message TEXT,
    timestamp DATE
);

-- Create the user
CREATE USER 'phpServer'@'%' IDENTIFIED BY 'paT[zEc7WmNvhPrE';

-- Grant SELECT and INSERT privileges on the database to the user
GRANT SELECT, INSERT ON web.* TO 'phpServer'@'%';

-- Flush privileges to ensure that the changes take effect
FLUSH PRIVILEGES;
