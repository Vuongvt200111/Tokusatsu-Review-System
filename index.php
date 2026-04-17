<?php
session_start();
require_once 'includes/DatabaseConnection.php';
require_once 'includes/DatabaseFunction.php';

$page = 'home';
ob_start();
include 'templates/home.html.php';
$output = ob_get_clean();
include 'templates/layout.html.php';
?>