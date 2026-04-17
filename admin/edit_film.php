<?php
$title = 'Update Film';
session_start();
require_once '../includes/DatabaseConnection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: " . BASE_URL . "index.php"); 
    exit;
}

$film_id = $_GET['id'] ?? ($_POST['film_id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM films WHERE id = :id");
$stmt->execute(['id' => $film_id]);
$film = $stmt->fetch();

if (!$film) {
    header("Location: " . BASE_URL . "list_films.php"); exit;
}

$stmt_cat = $pdo->query("SELECT * FROM category");
$categories = $stmt_cat->fetchAll();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'];
    
    $image = $film['images'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    if (empty($title) || empty($description) || empty($category_id)) {
        $error = 'Please enter all the required information!';
    } else {
        $sql = "UPDATE films SET title = :title, description = :description, category_id = :cat_id, images = :images WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'description' => $description, 'cat_id' => $category_id, 'images' => $image, 'id' => $film_id]);

        header("Location: " . BASE_URL . "list_films.php?status=edited");
        exit;
    }
}

$page_title = 'ADMIN - EDIT FILM';
$action_url = BASE_URL . 'admin/edit_film.php';

ob_start();
include 'templates/edit_film.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php';
?>