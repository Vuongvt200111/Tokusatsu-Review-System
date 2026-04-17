<?php
$title = "Contact Admin";
session_start();
require_once '../includes/DatabaseConnection.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . BASE_URL . 'login.php');
    exit;
}

$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_message = trim($_POST['user_message'] ?? '');

    if (empty($user_message)) {
        $error_msg = 'Please enter the content of the message!';
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, user_message, status, created_at) VALUES (:user_id, :user_message, 'pending', NOW())");
        $stmt->execute([
            'user_id' => $_SESSION['user_id'],
            'user_message' => $user_message
        ]);
        $success_msg = 'Your letter has been successfully sent! The admin will respond as soon as possible. Thank you!';
    }
}

ob_start();
include 'templates/contact_us.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php'; 
?>