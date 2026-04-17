<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$review_id = $_GET['id'] ?? 0;
$film_id = $_GET['film_id'] ?? 0;
$user_id = $_SESSION['user_id'];

if ($review_id && $film_id) {
    $sql_check = "SELECT id FROM reviews WHERE id = :id AND user_id = :user_id";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute(['id' => $review_id, 'user_id' => $user_id]);

    if ($stmt_check->rowCount() > 0) {
        $sql_del = "DELETE FROM reviews WHERE id = :id";
        $stmt_del = $pdo->prepare($sql_del);
        $stmt_del->execute(['id' => $review_id]);
        $_SESSION['review_success'] = "Review deleted successfully!";
    }
}

header("Location: ../review.php?id=" . $film_id);
exit;
?>