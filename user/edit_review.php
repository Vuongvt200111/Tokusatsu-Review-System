<?php
$title="Edit Review";
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$review_id = $_GET['id'] ?? ($_POST['review_id'] ?? 0);
$error = '';

$sql = "SELECT * FROM reviews WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $review_id, 'user_id' => $user_id]);
$review = $stmt->fetch();

$film_id = $review['film_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_review'])) {
    $rating = $_POST['rating'];
    $content = trim($_POST['content']);

    if (empty($content) || empty($rating)) {
        $error = "Please enter the full score and description.";
    } else {
        $sql_update = "UPDATE reviews SET rating = :rating, content = :content WHERE id = :id AND user_id = :user_id";
        $stmt_update = $pdo->prepare($sql_update);
        
        if ($stmt_update->execute(['rating' => $rating, 'content' => $content, 'id' => $review_id, 'user_id' => $user_id])) {
            $_SESSION['review_success'] = "Review updated successfully!";
            header("Location: ../review.php?id=" . $film_id);
            exit;
        } else {
            $error = "An error occurred, unable to update the database.";
        }
    }
}

ob_start();
include 'templates/edit_review.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php';
?>