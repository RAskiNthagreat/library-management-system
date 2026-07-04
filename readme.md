# Library Management System

## Description
A simple Library Management System built using Core PHP and MySQL developed for a university Full Stack Development coursework.  
The system allows users to perform full CRUD operations on books with search and AJAX live search functionality.


## Features

- Add new books
- View all books
- Edit existing book details
- Delete books with confirmation
- Search books by title, author, category, publisher
- AJAX live search (Fetch API)
- Server-side validation
- Client-side validation
- SQL Injection protection (Prepared Statements)
- XSS protection (htmlspecialchars)
- Responsive simple UI



## Technologies Used

- PHP (Core PHP)
- MySQL
- HTML5
- CSS3
- JavaScript (Vanilla JS)
- AJAX (Fetch API)



## Requirements

- XAMPP
- Apache Server
- MySQL
- PHP 8+
- Web Browser (Chrome recommended)



## Installation Steps

1. Install XAMPP
2. Start Apache and MySQL
3. Place project folder inside: C:\xampp\htdocs\

4. Create database using phpMyAdmin:
- Database name: `library`
5. Import SQL file:
6. Run project: http://localhost/library-management-system/public/

## Folder Structure

library-management-system/
│
├── config/
├── includes/
├── public/
│ ├── assets/
│ │ ├── css/
│ │ ├── js/
│ ├── index.php
│ ├── add.php
│ ├── edit.php
│ ├── delete.php
│ ├── search.php
│ ├── search_api.php
│
├── database/
│ └── library.sql
│
├── README.md




## Security Features

- All database queries use prepared statements
- User input is validated on both client and server side
- Output is escaped using `htmlspecialchars()` to prevent XSS



## Future Improvements

- User login system (Admin / Student roles)
- Book categories normalization
- Pagination for large datasets
- Advanced search filters
- Better UI using Bootstrap


## Author
Raskin KC