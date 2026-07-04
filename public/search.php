<?php
require_once "../config/db.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$stmt = $conn->prepare("SELECT * FROM books ORDER BY title ASC");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container content">

    <h1>Search Books</h1>

    <label for="search">Search Books</label>

    <input
        type="text"
        id="search"
        placeholder="Search by title, author, category or publisher">

    <br><br>

    <table>

        <thead>

            <tr>

                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>ISBN</th>
                <th>Quantity</th>

            </tr>

        </thead>

        <tbody id="book-results">

            <?php foreach ($books as $book): ?>

                <tr>

                    <td><?= htmlspecialchars($book['title']) ?></td>

                    <td><?= htmlspecialchars($book['author']) ?></td>

                    <td><?= htmlspecialchars($book['category']) ?></td>

                    <td><?= htmlspecialchars($book['publisher']) ?></td>

                    <td><?= htmlspecialchars($book['publication_year']) ?></td>

                    <td><?= htmlspecialchars($book['isbn']) ?></td>

                    <td><?= htmlspecialchars($book['quantity']) ?></td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php
require_once "../includes/footer.php";
?>