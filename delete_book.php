<?php
session_start();
require 'db.php';

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: books.php");
    } catch (Exception $e) {
        header("Location: error.php");
    }
}
?>
