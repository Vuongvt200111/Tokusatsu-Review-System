<?php
$title = 'Add Film';
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: " . BASE_URL . "index.php"); 
    exit;
}

$stmt_cat = $pdo->query("SELECT * FROM category");
$categories = $stmt_cat->fetchAll();
$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['user_id']; // ID của Admin
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    if (empty($title) || empty($description) || empty($category_id) || empty($image)) {
        $error = 'Please fill in all the information and select a poster image!';
    } else {
        $sql = "INSERT INTO films (title, description, category_id, images, user_id, status, created_at) 
                VALUES (:title, :description, :cat_id, :images, :user_id, 'approved', NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'title' => $title, 
            'description' => $description, 
            'cat_id' => $category_id, 
            'images' => $image, 
            'user_id' => $user_id
        ]);
        
        header("Location: " . BASE_URL . "list_films.php?status=added");
        exit;
    }
}

$page_title = 'Admin - Add New Film';
$action_url = 'add_film.php';

ob_start();
include 'templates/add_film.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php'; 
?>