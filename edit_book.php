<?php
session_start();
require 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $title = $_POST['book_title'];
        $author = $_POST['author'];

        $stmt = $conn->prepare("UPDATE books SET book_title=?, author=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $author, $id);
        $stmt->execute();

        header("Location: books.php");
    } catch (Exception $e) {
        header("Location: error.php");
    }
} else {
    $query = "SELECT * FROM books WHERE id=$id";
    $result = $conn->query($query);
    $book = $result->fetch_assoc();
}
?>

<form method="post">
    <label>Title: <input type="text" name="book_title" value="<?= $book['book_title']; ?>" required></label>
    <label>Author: <input type="text" name="author" value="<?= $book['author']; ?>" required></label>
    <input type="submit" value="Update Book">
</form>
