<?php
require_once "../config/db.php";

$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $sql = "SELECT * FROM books
            WHERE title LIKE ?
               OR author LIKE ?
               OR category LIKE ?
               OR publisher LIKE ?
            ORDER BY title ASC";

    $stmt = $conn->prepare($sql);

    $searchTerm = "%{$search}%";

    $stmt->execute([
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm
    ]);

} else {

    $stmt = $conn->prepare("SELECT * FROM books ORDER BY title ASC");
    $stmt->execute();

}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($books) > 0) {

    foreach ($books as $book) {

        echo "<tr>";

        echo "<td>" . htmlspecialchars($book['title']) . "</td>";

        echo "<td>" . htmlspecialchars($book['author']) . "</td>";

        echo "<td>" . htmlspecialchars($book['category']) . "</td>";

        echo "<td>" . htmlspecialchars($book['publisher']) . "</td>";

        echo "<td>" . htmlspecialchars($book['publication_year']) . "</td>";

        echo "<td>" . htmlspecialchars($book['isbn']) . "</td>";

        echo "<td>" . htmlspecialchars($book['quantity']) . "</td>";

        echo "</tr>";
    }

} else {

    echo "<tr>";
    echo "<td colspan='7'>No matching books found.</td>";
    echo "</tr>";

}