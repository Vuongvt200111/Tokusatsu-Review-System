<?php
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

$error = '';
$success = '';

$sql = "SELECT COUNT(*) FROM users WHERE role = 1 AND (is_deleted = 0 OR is_deleted IS NULL)";
$stmt = query($pdo, $sql);
$adminCount = $stmt->fetchColumn();

if ($adminCount > 0) {
    die("<h2 style='color:red; text-align:center; margin-top:50px;'>System already has an active Admin. You cannot set up more from here! Please go to the Dashboard to add.</h2>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (!str_ends_with(strtolower($email), '@tokusatsu.com')) {
        $error = "Error: System only accepts internal emails ending with @tokusatsu.com!";}
    else {
        try {
            insert($pdo, 'users', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => 1,
            'credibility_score' => 9999,
            'badge' => 'Administrator'
        ]);
        $success = "Setup Admin No.1 successful! Please proceed to the Login page.";
        } 
        catch (Exception $e) {
            $error = "Database Error: " . $e->getMessage();
            }
        }
}

include 'templates/setup_admin.html.php';
?>