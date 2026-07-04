<?php
require_once "../config/db.php";

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid book ID.");
}

$id = (int) $_GET['id'];

// Delete the book
$stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
$stmt->execute([$id]);

// Redirect back to homepage
header("Location: index.php");
exit();