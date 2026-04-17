<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: " . BASE_URL . "index.php"); 
    exit;
}

$film_id = $_GET['id'] ?? 0;

if ($film_id) {
    $stmt_get = $pdo->prepare("SELECT images FROM films WHERE id = :id");
    $stmt_get->execute(['id' => $film_id]);
    $film = $stmt_get->fetch();

    if ($film && !empty($film['images'])) {
        $image_path = '../uploads/' . $film['images']; 
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    
    $stmt_del = $pdo->prepare("DELETE FROM films WHERE id = :id");
    $stmt_del->execute(['id' => $film_id]);
}

header("Location: " . BASE_URL . "list_films.php?status=deleted");
exit;
?>
