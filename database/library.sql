-- Library Management System Database

-- creating database
CREATE DATABASE IF NOT EXISTS library;

-- Selecting database
USE library;

-- Dropping table if it already exists
DROP TABLE IF EXISTS books;

-- Creating books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150) NOT NULL,
    category VARCHAR(100) NOT NULL,
    publisher VARCHAR(150) NOT NULL,
    publication_year YEAR NOT NULL,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO books
(title, author, category, publisher, publication_year, isbn, quantity)
VALUES
('The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction', 'Scribner', 1925, '9780743273565', 5),

('Clean Code', 'Robert C. Martin', 'Programming', 'Prentice Hall', 2008, '9780132350884', 8),

('Introduction to Algorithms', 'Thomas H. Cormen', 'Computer Science', 'MIT Press', 2022, '9780262046305', 4),

('The Pragmatic Programmer', 'Andrew Hunt', 'Programming', 'Addison-Wesley', 2019, '9780135957059', 6),

('Database System Concepts', 'Abraham Silberschatz', 'Database', 'McGraw-Hill', 2019, '9781260084504', 3);