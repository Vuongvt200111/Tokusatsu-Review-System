<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <?php if (isset($page) && $page == 'home'): ?>
        <link rel="stylesheet" href="css/index.css">
    <?php endif; ?>

    <title>Tokusatsu Universe</title>
</head>

<body class="<?= isset($page) && $page == 'home' ? 'home-page' : '' ?>">

<header>
    <h1 class="main-title">Tokusatsu Universe</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="list_films.php">Tokusatsu films</a></li>
    </ul>
</nav>

<main>
    <?= $output ?>
</main>

<footer>&copy; 2026 Tokusatsu Universe</footer>

</body>
</html>