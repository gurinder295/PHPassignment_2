<?php
// LISTING BOOKS WITH EDIT AND DELETE OPTIONS
require 'db.php';
$stmt = $pdo->query("SELECT books.id, book_title, author, category_name FROM books JOIN categories ON books.category_id = categories.id");
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Book List</h2>
    <a href="create.php">Add New Book</a>
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
                <td><?= $book['id'] ?></td>
                <td><?= $book['book_title'] ?></td>
                <td><?= $book['author'] ?></td>
                <td><?= $book['category_name'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $book['id'] ?>">Edit</a>
                    <a href="delete.php?id=<?= $book['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
