<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 1 && $_SESSION['role'] !== 'admin')) {
    header('Location: ../list_films.php');
    exit;
}

$current_admin_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $target_user_id = $_GET['id'];

    if ($target_user_id == 1 && $current_admin_id != 1) {
        header('Location: manage_users.php?status=denied');
        exit;
    }

    try {
        $sql = "UPDATE users SET is_deleted = 0, status = 'active' WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $target_user_id]);

        header('Location: manage_users.php?status=restored'); 
        exit;

    } catch (PDOException $e) {
        die("System error: " . $e->getMessage());
    }
} else {
    header('Location: manage_users.php');
    exit;
}
?>