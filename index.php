<?php
session_start(); // Start session for authentication management
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Book Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?> 
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
