DROP DATABASE IF EXISTS mini_login_owner;
CREATE DATABASE mini_login_owner CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mini_login_owner;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    author VARCHAR(100),
    user_id INT
);

INSERT INTO users (name, email, password) VALUES
('Demo User', 'demo@test.com', '$2y$12$oQXvwiQ3wf1oWKkPfTDEluSbXzuOtHOcTY6Tj8Ta4cFRNPvFQ0gbi');

INSERT INTO books (title, author, user_id) VALUES
('Demo Book', 'Demo Author', 1);
