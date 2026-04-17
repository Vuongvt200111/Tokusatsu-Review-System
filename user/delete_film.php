<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] == 1)) {
    header("Location: " . BASE_URL . "list_film.php"); exit;
}

$film_id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

if ($film_id) {
    $stmt_check = $pdo->prepare("SELECT id, images FROM films WHERE id = :id AND user_id = :user_id");
    $stmt_check->execute(['id' => $film_id, 'user_id' => $user_id]);
    $film = $stmt_check->fetch();
    
    if ($film && !empty($film['images'])) {
        $image_path = '../uploads/' . $film['images']; 
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    if ($stmt_check->rowCount() > 0) {
        $stmt_del = $pdo->prepare("DELETE FROM films WHERE id = :id");
        $stmt_del->execute(['id' => $film_id]);
    }
}

header("Location: ../list_films.php");
exit;
?>