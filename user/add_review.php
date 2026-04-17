<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit_review'])) {
    header("Location: " . BASE_URL . "list_films.php");
    exit;
}

$film_id = $_POST['film_id'] ?? 0;

if (!isset($_SESSION['user_id'])) {
    $_SESSION['review_error'] = "You must be logged in to write a review!";
    header("Location: ../review.php?id=" . $film_id);
    exit;
}

$rating = $_POST['rating'] ?? 0;
$content = trim($_POST['content'] ?? '');
$user_id = $_SESSION['user_id'];

if (empty($content) || empty($rating)) {
    $_SESSION['review_error'] = "Please fill in all fields.";
    header("Location: ../review.php?id=" . $film_id);
    exit;
}

try {
    $sql_insert = "INSERT INTO reviews (film_id, user_id, rating, content) VALUES (:film_id, :user_id, :rating, :content)";
    $stmt_insert = $pdo->prepare($sql_insert);
    $stmt_insert->execute([
        'film_id' => $film_id,
        'user_id' => $user_id,
        'rating' => $rating,
        'content' => $content
    ]);
    
    $_SESSION['review_success'] = "Thank you for reviewing this film!";
} catch (PDOException $e) {
    $_SESSION['review_error'] = "An error occurred, unable to submit review: " . $e->getMessage();
}

header("Location: ../review.php?id=" . $film_id);
exit;
?>