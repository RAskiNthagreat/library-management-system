<?php
require_once "../config/db.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

// Fetch all books
$sql = "SELECT * FROM books ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container content">

    <h1>Library Books</h1>

    <table class="book-table">

        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>ISBN</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

        <?php if (count($books) > 0): ?>

            <?php foreach ($books as $book): ?>

                <tr>

                    <td><?= htmlspecialchars($book['title']) ?></td>

                    <td><?= htmlspecialchars($book['author']) ?></td>

                    <td><?= htmlspecialchars($book['category']) ?></td>

                    <td><?= htmlspecialchars($book['publisher']) ?></td>

                    <td><?= htmlspecialchars($book['publication_year']) ?></td>

                    <td><?= htmlspecialchars($book['isbn']) ?></td>

                    <td><?= htmlspecialchars($book['quantity']) ?></td>

                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>">Edit</a> |
                        <a
                        href="delete.php?id=<?= $book['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this book?');"
                        >
                        Delete
                        </a>
                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="8">No books found.</td>
            </tr>

        <?php endif; ?>

        </tbody>

    </table>

</div>

<?php
require_once "../includes/footer.php";
?>