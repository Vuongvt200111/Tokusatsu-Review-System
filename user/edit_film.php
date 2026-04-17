<?php
$title = 'Edit Film';
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] == 1)) {
    header("Location: " . BASE_URL . "list_films.php"); 
    exit;
}

$film_id = $_GET['id'] ?? ($_POST['film_id'] ?? 0);
$user_id = $_SESSION['user_id'];
$parameters = ['id' => $film_id, 'user_id' => $user_id];

$film = query($pdo, "SELECT * FROM films WHERE id = :id AND user_id = :user_id", $parameters)->fetch();

$categories = findAllWithJoin($pdo, "SELECT * FROM category");

$error = ''; 
$success = '';
$page_title = 'EDIT INFORMATION FILM';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $film_title  = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = $_POST['category_id'];
    $image = $film['images'] ?? ''; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    if (empty($film_title) || empty($description) || empty($category_id)) {
        $error = 'Please enter all the required information!';

    } else {
        $fields = [
            'title'       => $film_title,
            'description' => $description,
            'category_id' => $category_id,
            'images'      => $image,
            'id'          => $film_id,
            'status'      => 'pending',
            'created_at'  => date('NOW()')
        ];
        
        update($pdo, 'films', 'id', $fields);

        $success = 'Your video has been successfully updated and is awaiting administrator approval. Thank you!';
        $film['title']       = $film_title;
        $film['description'] = $description;
        $film['category_id'] = $category_id;
        $film['images']      = $image;
    }
}

ob_start();
include 'templates/edit_film.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php';
?>