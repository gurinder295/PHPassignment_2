<?php
session_start(); // Start the session to manage user authentication

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not authenticated
    exit();
}

require 'db_connect.php'; // Include database connection file

// Initialize variables
$categories = [];
$books = [];
$message = "";

// Fetch categories for the dropdown
try {
    $stmt = $pdo->query("SELECT id, category_name FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error fetching categories: " . $e->getMessage();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = trim($_POST['book_title']);
    $author = trim($_POST['author']);
    $category_id = $_POST['category_id'];
    
    // Validate inputs
    if (empty($book_title) || empty($author) || empty($category_id)) {
        $message = "All fields are required.";
    } else {
        try {
            // Insert into database using PDO
            $stmt = $pdo->prepare("INSERT INTO books (book_title, author, category_id) VALUES (?, ?, ?)");
            $stmt->execute([$book_title, $author, $category_id]);
            $message = "New book added successfully!";
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}

// Fetch all books with category names
try {
    $stmt = $pdo->query("SELECT b.id, b.book_title, b.author, c.category_name 
                         FROM books b JOIN categories c ON b.category_id = c.id");
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = "Error fetching books: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>

<?php include 'header.php'; ?> <!-- Include navigation -->

<main>
    <h1>Book Management System</h1>
    
    <?php if ($message): ?>
        <p style="color: red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Form to add a new book -->
    <form action="" method="post">
        <label for="book_title">Book Title:</label>
        <input type="text" id="book_title" name="book_title" required>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            <option value="">Select a category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['id']) ?>">
                    <?= htmlspecialchars($category['category_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Add Book">
    </form>

    <h2>Book List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($books as $book): ?>
        <tr>
            <td><?= htmlspecialchars($book['id']) ?></td>
            <td><?= htmlspecialchars($book['book_title']) ?></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= htmlspecialchars($book['category_name']) ?></td>
            <td>
                <a href="edit_book.php?id=<?= $book['id'] ?>">Edit</a> | 
                <a href="delete_book.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>

</body>
</html>
