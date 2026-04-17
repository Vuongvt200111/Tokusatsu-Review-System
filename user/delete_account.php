<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("UPDATE users SET is_deleted = 1 WHERE id = :id");
$stmt->execute(['id' => $user_id]);

session_unset();  
session_destroy(); 

header("Location: " . BASE_URL . "list_films.php?status=account_deleted");
exit;
?>