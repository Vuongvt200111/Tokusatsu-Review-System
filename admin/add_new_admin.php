<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: ../list_film.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Please fill in all the information!';
    } else {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        
        if ($stmt->fetchColumn() > 0) {
            $error = 'This email already exists in the system!';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, 1)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password
            ]);
            $success = 'New admin account created successfully!';
        }
    }
}

ob_start();
include 'templates/add_new_admin.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>