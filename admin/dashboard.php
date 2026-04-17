<?php
$title = 'Admin Dashboard';
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: ../list_films.php');
    exit;
}

$totalFilms = countRecords($pdo, 'films');
$totalReviews = countRecords($pdo, 'reviews');
$totalUsers = countRecords($pdo, 'users');

ob_start();
include 'templates/dashboard.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>