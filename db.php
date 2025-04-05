<?php
try {
    $pdo = new PDO("mysql:host= 172.31.22.43 ;dbname=Gurinder20062263", "Gurinder200622633", "Pl-RQ81j6d");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
