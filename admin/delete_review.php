<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: " . BASE_URL . "index.php"); 
    exit;
}

$review_id = $_GET['id'] ?? 0;
$film_id = $_GET['film_id'] ?? 0;

if ($review_id) {
    $stmt_del = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
    $stmt_del->execute(['id' => $review_id]);
}

if ($film_id) {
    header("Location: " . BASE_URL . "review.php?id=" . $film_id . "&status=review_deleted");
} else {
    header("Location: " . BASE_URL . "list_films.php");
}
exit;
?>