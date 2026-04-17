<?php
$title = "List Films";
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

$current_category = isset($_GET['category']) ? $_GET['category'] : 'all';

if ($current_category !== 'all') {
    $sql = "SELECT films.*, users.name AS uploader_name, category.category_name 
            FROM films
            JOIN users ON films.user_id = users.id 
            JOIN category ON films.category_id = category.id 
            WHERE films.status = 'approved' AND category.category_name = :category
            ORDER BY films.created_at DESC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['category' => $current_category]);
    $films = $stmt->fetchAll();
    
} else {
    $sql = "SELECT films.*, users.name AS uploader_name, category.category_name 
            FROM films
            JOIN users ON films.user_id = users.id 
            JOIN category ON films.category_id = category.id 
            WHERE films.status = 'approved'
            ORDER BY films.created_at DESC";
            
    $films = findAllWithJoin($pdo, $sql); 
}

ob_start();
include 'templates/home_list_films.html.php';
$content = ob_get_clean();
include 'templates/layout_list_films.html.php';
?>