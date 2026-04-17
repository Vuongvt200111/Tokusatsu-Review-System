<?php
session_start();
session_unset();
session_destroy(); 

header("Location: list_films.php");
exit();
?>