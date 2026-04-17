<?php
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_check = "SELECT * FROM users WHERE email = :email";
    $stmt = query($pdo, $sql_check, ['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        if ($user['is_deleted'] == 1) {
            $error = "Your account has been deleted. Please contact the Administrator to restore it.";
            } 
            else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];

        if ($user['role'] == 1 || $user['role'] === 'admin') {
            header("Location: " . BASE_URL . "admin/dashboard.php");
        } else {
            header("Location: " . BASE_URL . "list_films.php");
        }
        exit;
    }
} else {
        $error = "Email or password is incorrect!";
    }
}

include 'templates/login.html.php';
?>