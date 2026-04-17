<?php
$title= "Profile";
session_start();
require_once 'includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$error = ''; 
$success = '';

$stmt_cat = $pdo->query("SELECT id, category_name FROM category ORDER BY category_name ASC");
$categories = $stmt_cat->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$userInfo = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name']);
    $bio = trim($_POST['bio']);
    $favorite_genre = trim($_POST['favorite_genre']); 

    $avatar = $userInfo['avatar']; 
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $avatar = 'avatar_' . time() . '_' . basename($_FILES['avatar']['name']);
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/' . $avatar)) {
            $error = 'Profile picture upload error!';
        }
    }

    if (empty($name)) {
        $error = 'The display name cannot be left blank!';
    }

    if (empty($error)) {
        $sql = "UPDATE users SET name = :name, bio = :bio, favorite_genre = :category_id, avatar = :avatar WHERE id = :id";
        $stmt_update = $pdo->prepare($sql);
        $stmt_update->execute([
            'name' => $name,
            'bio' => $bio,
            'category_id' => $favorite_genre,
            // 'status' => $status,
            'avatar' => $avatar,
            'id' => $user_id
        ]);

        $_SESSION['name'] = $name;

        $success = "Profile updated successfully!";
        $userInfo['name'] = $name;
        $userInfo['bio'] = $bio;
        $userInfo['favorite_genre'] = $favorite_genre;
        // $userInfo['status'] = $status;
        $userInfo['avatar'] = $avatar;
    }
}

ob_start();
include 'templates/profile.html.php';
$content = ob_get_clean();
include 'templates/layout_list_films.html.php';
?>