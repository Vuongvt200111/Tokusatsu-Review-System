<?php
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header('Location: ../list_film.php');
    exit;
}

$msg_alert = '';

if (isset($_POST['reply_id'])) {
    $reply_id = $_POST['reply_id'];
    $admin_reply = trim($_POST['admin_reply'] ?? '');
    
    if (!empty($admin_reply)) {
        $stmt = $pdo->prepare("UPDATE messages SET admin_reply = :reply, status = 'replied', updated_at = NOW() WHERE id = :id");
        $stmt->execute([
            'reply' => $admin_reply,
            'id' => $reply_id
        ]);
        $msg_alert = "<div class='alert alert-success fw-bold shadow'>User response successful!</div>";
    }
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $stmt->execute(['id' => $delete_id]);
    $msg_alert = "<div class='alert alert-warning fw-bold shadow'>Message deleted successfully!</div>";
}

$query = "SELECT m.*, u.name, u.email 
          FROM messages m 
          LEFT JOIN users u ON m.user_id = u.id 
          ORDER BY m.id DESC";
$stmt = $pdo->query($query);
$messages = $stmt->fetchAll();

ob_start();
include 'templates/messages.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>