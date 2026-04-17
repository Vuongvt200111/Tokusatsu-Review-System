<?php
$title= 'Rate and review films';
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: list_films.php");
    exit;
}

$film_id = $_GET['id'];
$error = $_SESSION['review_error'] ?? '';
$success = $_SESSION['review_success'] ?? '';

unset($_SESSION['review_error'], $_SESSION['review_success']);

try {
    $sql_film = "SELECT films.*, users.name AS uploader_name, category.category_name AS category_name 
                 FROM films 
                 JOIN users ON films.user_id = users.id 
                 JOIN category ON films.category_id = category.id 
                 WHERE films.id = :id";
    $stmt_film = $pdo->prepare($sql_film);
    $stmt_film->execute(['id' => $film_id]);
    $film = $stmt_film->fetch();

    $sql_reviews = "SELECT reviews.*, users.name AS reviewer_name 
                    FROM reviews 
                    JOIN users ON reviews.user_id = users.id 
                    WHERE reviews.film_id = :film_id 
                    ORDER BY reviews.created_at DESC";
    $stmt_reviews = $pdo->prepare($sql_reviews);
    $stmt_reviews->execute(['film_id' => $film_id]);
    $reviews = $stmt_reviews->fetchAll();

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

ob_start();
include 'templates/review.html.php';
$content = ob_get_clean();
include 'templates/layout_list_films.html.php'; 
?>