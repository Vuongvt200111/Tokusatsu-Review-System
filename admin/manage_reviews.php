<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: ../list_films.php');
    exit;
}

$msg_alert = '';

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
    $stmt->execute(['id' => $delete_id]);
    
    $msg_alert = "<div class='alert alert-warning alert-dismissible fade show fw-bold shadow-sm'>
                    The inappropriate review has been successfully removed from the system!
                    <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                  </div>";
}

$query = "SELECT r.id, r.rating, r.content, r.created_at, 
                 u.name AS user_name, 
                 f.title AS film_title 
          FROM reviews r 
          LEFT JOIN users u ON r.user_id = u.id 
          LEFT JOIN films f ON r.film_id = f.id 
          ORDER BY r.id DESC";
$stmt = $pdo->query($query);
$reviews = $stmt->fetchAll();

ob_start();
include 'templates/manage_reviews.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>