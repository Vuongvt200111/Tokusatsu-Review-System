<?php
$title = 'Add Film';
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] == 1)) {
    header("Location: " . BASE_URL . "list_films.php"); 
    exit;
}

$categories = findAllWithJoin($pdo, "SELECT * FROM category");

$error = ''; 
$success = '';
$film = ['title' => '', 'description' => '', 'category_id' => '']; 
$page_title = 'POST A NEW FILM';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $film_title     = trim($_POST['title']);
    $description    = trim($_POST['description']);
    $category_id    = $_POST['category_id'];
    $user_id        = $_SESSION['user_id'];
    $image          = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $image);
    }

    if (empty($film_title) || empty($description) || empty($category_id) || empty($image))
        {
        $error = 'Please enter all the required information and select a poster image!';
        $film = [
            'title' => $film_title, 
            'description' => $description, 
            'category_id' => $category_id
        ];

    } else {
        $fields = [
            'title'       => $film_title,
            'description' => $description,
            'category_id' => $category_id,
            'images'      => $image,
            'user_id'     => $user_id,
            'status'      => 'pending',
            'created_at'  => date('NOW()')
        ];
        
        insert($pdo, 'films', $fields);

        $success = 'Your film has been successfully posted and is awaiting admin approval. Thank you!';
        $film = ['title' => '', 'description' => '', 'category_id' => ''];
    }
}

ob_start();
include 'templates/add_film.html.php';
$content = ob_get_clean();
include '../templates/layout_list_films.html.php';
?>