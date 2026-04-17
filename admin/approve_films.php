<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: ../list_film.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['film_id'])) {
        $film_id = $_POST['film_id'];
        
        if ($_POST['action'] == 'approve') {
            $sql = "UPDATE films SET status = 'approved' WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $film_id]);
            $msg = "<div class='alert alert-success'>Film approved and published!</div>";
            
        } elseif ($_POST['action'] == 'reject') {
            $sql = "DELETE FROM films WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $film_id]);
            $msg = "<div class='alert alert-danger'>Rejected and deleted the trashy video!</div>";
        }
    }
}

$sql = "SELECT films.*, users.name as uploader_name 
        FROM films 
        JOIN users ON films.user_id = users.id 
        WHERE films.status = 'pending' 
        ORDER BY films.created_at ASC";
$stmt = $pdo->query($sql);
$pending_films = $stmt->fetchAll();

ob_start();
include 'templates/approve_films.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>