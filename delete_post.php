<?php
include 'includes/db.php';

$id = $_GET['id'];
$category = $_GET['category'];

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: category.php?category=$category");
?>
