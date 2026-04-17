<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 1 && $_SESSION['role'] !== 'admin')) {
    header('Location: ../list_films.php');
    exit;
}

$current_admin_id = $_SESSION['user_id'];
$message = '';

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    if ($delete_id == 1){}
    else {
        $stmt_check = $pdo->prepare("SELECT role FROM users WHERE id = :id");
        $stmt_check->execute(['id' => $delete_id]);
        $target_user = $stmt_check->fetch();

        if ($target_user) {
            $is_target_admin = ($target_user['role'] == 1 || $target_user['role'] === 'admin');

            if ($current_admin_id == 1) {

                $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
                $stmt->execute(['id' => $delete_id]);
                $message = "The boss has successfully banned the account!";
            } else {

                if ($delete_id == $current_admin_id) {

                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
                    $stmt->execute(['id' => $delete_id]);

                    echo "<script>
                        alert('You have SELF-DELETED your admin account. The system will log you out immediately!');
                        window.location.href = '../logout.php';
                    </script>";
                    exit;
                } else {
                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
                    $stmt->execute(['id' => $delete_id]);
                    $message = "The account has been successfully deleted!";
                }
            }
        }
    }
}

if ($current_admin_id == 1) {
    $stmt = $pdo->prepare("SELECT id, name, email, role, status, is_deleted, created_at FROM users ORDER BY role DESC, id DESC");
} else {
    $stmt = $pdo->prepare("SELECT id, name, email, role, status, is_deleted, created_at FROM users WHERE id != 1 ORDER BY role DESC, id DESC");
}
$stmt->execute();
$users = $stmt->fetchAll();

ob_start();
include 'templates/manage_users.html.php';
$content = ob_get_clean();
include 'templates/layout_admin.html.php';
?>