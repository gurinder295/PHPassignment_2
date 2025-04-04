<?php
session_start(); // Start session for authentication management
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Book Management System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>

<?php include 'header.php'; ?> <!-- Include shared navigation -->

<main>
    <h1>Welcome to the Book Management System</h1>
    <p>
        This system allows users to efficiently manage a collection of books.
        Users can add new books, assign them to categories, update details, and delete entries.
        The project was built using:
    </p>
    <ul>
        <li><strong>PHP (PDO)</strong> – For secure database interactions</li>
        <li><strong>MySQL</strong> – To store books and category data</li>
        <li><strong>HTML & CSS</strong> – For a structured and responsive UI</li>
        <li><strong>JavaScript</strong> – To enhance user experience</li>
        <li><strong>AWS Deployment</strong> – To host the system online</li>
    </ul>

    <h2>Get Started</h2>
    <p>Navigate to different sections of the site:</p>
    <ul>
        <li><a href="books.php">Manage Books</a> - View, add, edit, and delete books</li>
        <li><a href="categories.php">Manage Categories</a> - Organize books into categories</li>
        <li><a href="register.php">Register</a> / <a href="login.php">Login</a> - Secure user authentication</li>
    </ul>
</main>

</body>
</html>

<!-- header.php -->
<?php
// Start the session
session_start();
?>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Manage Books</a></li>
            <li><a href="categories.php">Manage Categories</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Logout (<?php echo $_SESSION['user']; ?>)</a></li>
            <?php else: ?>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- books.php -->
<?php
require 'db_connect.php'; // Include database connection

// Fetch books
$sql = "SELECT books.id, books.book_title, books.author, categories.category_name FROM books 
        JOIN categories ON books.category_id = categories.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
</head>
<body>
<?php include 'header.php'; ?>
<h1>Book List</h1>
<a href="add_book.php">Add New Book</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?php echo $book['id']; ?></td>
        <td><?php echo $book['book_title']; ?></td>
        <td><?php echo $book['author']; ?></td>
        <td><?php echo $book['category_name']; ?></td>
        <td>
            <a href="edit_book.php?id=<?php echo $book['id']; ?>">Edit</a> |
            <a href="delete_book.php?id=<?php echo $book['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

