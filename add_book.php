<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $title = $_POST['book_title'];
        $author = $_POST['author'];
        $category = $_POST['category_id'];

        $stmt = $conn->prepare("INSERT INTO books (book_title, author, category_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $title, $author, $category);
        $stmt->execute();
        
        header("Location: books.php");
    } catch (Exception $e) {
        header("Location: error.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <h2>Add New Book</h2>
    <form method="post">
        <label>Title: <input type="text" name="book_title" required></label>
        <label>Author: <input type="text" name="author" required></label>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>
