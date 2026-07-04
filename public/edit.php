<?php
require_once "../config/db.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$errors = [];

// Check if ID exists
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid book ID.");
}

$id = (int) $_GET['id'];

// Fetch book
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);

$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Book not found.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $category = trim($_POST["category"]);
    $publisher = trim($_POST["publisher"]);
    $publication_year = trim($_POST["publication_year"]);
    $isbn = trim($_POST["isbn"]);
    $quantity = trim($_POST["quantity"]);

    // Validation
    if ($title === "") $errors[] = "Title is required.";
    if ($author === "") $errors[] = "Author is required.";
    if ($category === "") $errors[] = "Category is required.";
    if ($publisher === "") $errors[] = "Publisher is required.";
    if ($publication_year === "") $errors[] = "Publication year is required.";
    if ($isbn === "") $errors[] = "ISBN is required.";

    if (!is_numeric($quantity) || $quantity < 1) {
        $errors[] = "Quantity must be at least 1.";
    }

    if (empty($errors)) {

        $sql = "UPDATE books
                SET
                    title = ?,
                    author = ?,
                    category = ?,
                    publisher = ?,
                    publication_year = ?,
                    isbn = ?,
                    quantity = ?
                WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            $title,
            $author,
            $category,
            $publisher,
            $publication_year,
            $isbn,
            $quantity,
            $id
        ]);

        header("Location: index.php");
        exit();
    }

    // Update displayed values if validation fails
    $book = [
        "title" => $title,
        "author" => $author,
        "category" => $category,
        "publisher" => $publisher,
        "publication_year" => $publication_year,
        "isbn" => $isbn,
        "quantity" => $quantity
    ];
}
?>

<div class="container content">

<h1>Edit Book</h1>

<?php if (!empty($errors)): ?>

<div class="error-box">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php endif; ?>

<form method="POST">

<label>Title</label>
<input
type="text"
name="title"
required
value="<?= htmlspecialchars($book['title']) ?>">

<label>Author</label>
<input
type="text"
name="author"
required
value="<?= htmlspecialchars($book['author']) ?>">

<label>Category</label>
<input
type="text"
name="category"
required
value="<?= htmlspecialchars($book['category']) ?>">

<label>Publisher</label>
<input
type="text"
name="publisher"
required
value="<?= htmlspecialchars($book['publisher']) ?>">

<label>Publication Year</label>
<input
type="number"
name="publication_year"
min="1000"
max="2100"
required
value="<?= htmlspecialchars($book['publication_year']) ?>">

<label>ISBN</label>
<input
type="text"
name="isbn"
required
value="<?= htmlspecialchars($book['isbn']) ?>">

<label>Quantity</label>
<input
type="number"
name="quantity"
min="1"
required
value="<?= htmlspecialchars($book['quantity']) ?>">

<button type="submit">
Update Book
</button>

</form>

</div>

<?php
require_once "../includes/footer.php";
?>