<?php
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

$error = '';
$success = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = query($pdo, "SELECT * FROM users WHERE email = :email", ['email' => $email]);

     if (!str_ends_with(strtolower($email), '@tokusatsu.com')) {
        $error = "Error: System only accepts internal emails ending with @tokusatsu.com!";}
        else {
        if ($stmt->fetch()) {
        $error = "This email already exists in the system!";
    } else {
        try {
            insert($pdo, 'users', [
                'name' => $_POST['name'],
                'email' => $email,
                'password' => $password,
                'role' => 'user',
                'credibility_score' => 0,
                'badge' => 'Member'
            ]);
            $success = "Registration successful! Please proceed to Log in.";
        } catch (Exception $e) {
            $error = "System error: " . $e->getMessage();
        }
    }
}}

include 'templates/register.html.php';
?>