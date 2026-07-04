<?php
require_once "../config/db.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $category = trim($_POST["category"]);
    $publisher = trim($_POST["publisher"]);
    $publication_year = trim($_POST["publication_year"]);
    $isbn = trim($_POST["isbn"]);
    $quantity = trim($_POST["quantity"]);

    // Server-side validation
    if ($title === "") $errors[] = "Title is required.";
    if ($author === "") $errors[] = "Author is required.";
    if ($category === "") $errors[] = "Category is required.";
    if ($publisher === "") $errors[] = "Publisher is required.";
    if ($publication_year === "") $errors[] = "Publication year is required.";
    if ($isbn === "") $errors[] = "ISBN is required.";
    if ($quantity === "" || !is_numeric($quantity) || $quantity < 1) {
        $errors[] = "Quantity must be at least 1.";
    }

    if (empty($errors)) {

        $sql = "INSERT INTO books
        (title, author, category, publisher, publication_year, isbn, quantity)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->execute([
            $title,
            $author,
            $category,
            $publisher,
            $publication_year,
            $isbn,
            $quantity
        ]);

        header("Location: index.php");
        exit();
    }
}
?>

<div class="container content">

<h1>Add New Book</h1>

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
value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">

<label>Author</label>
<input
type="text"
name="author"
required
value="<?= htmlspecialchars($_POST['author'] ?? '') ?>">

<label>Category</label>
<input
type="text"
name="category"
required
value="<?= htmlspecialchars($_POST['category'] ?? '') ?>">

<label>Publisher</label>
<input
type="text"
name="publisher"
required
value="<?= htmlspecialchars($_POST['publisher'] ?? '') ?>">

<label>Publication Year</label>
<input
type="number"
name="publication_year"
min="1000"
max="2100"
required
value="<?= htmlspecialchars($_POST['publication_year'] ?? '') ?>">

<label>ISBN</label>
<input
type="text"
name="isbn"
required
value="<?= htmlspecialchars($_POST['isbn'] ?? '') ?>">

<label>Quantity</label>
<input
type="number"
name="quantity"
min="1"
required
value="<?= htmlspecialchars($_POST['quantity'] ?? '') ?>">

<button type="submit">
Add Book
</button>

</form>

</div>

<?php
require_once "../includes/footer.php";
?>