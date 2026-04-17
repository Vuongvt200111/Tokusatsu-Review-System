<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Website' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/list_films.css">
    <link rel="stylesheet" href="css/filter.css">
</head>

<body class="<?= $body_class ?? '' ?>">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75 shadow">
        <div class="container">

            <a class="navbar-brand text-danger fw-bold" href="<?= BASE_URL ?>list_films.php">
                TOKUSATSU FILMS
            </a>

            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_URL ?>index.php">Home</a>
                </li>
                </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="<?= BASE_URL ?>profile.php" class="btn btn-info me-2 fw-bold">Profile</a>

                    <?php if ($_SESSION['role'] != 1): ?>
                        <a href="<?= BASE_URL ?>user/contact_us.php" class="btn btn-primary me-2 fw-bold">Contact us</a>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] == 1): ?>
                        <a href="<?= BASE_URL ?>admin/add_film.php" class="btn btn-warning me-2 fw-bold">+ Post Film</a>
                        <a href="<?= BASE_URL ?>admin/dashboard.php" class="btn btn-danger me-2 fw-bold">Control panel</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>user/add_film.php" class="btn btn-warning me-2 fw-bold">+ Post Film</a>

                    <?php endif; ?>
                        <a href="<?= BASE_URL ?>logout.php" class="btn btn-outline-light">Log out 
                            (<?= htmlspecialchars($_SESSION['name'] ?? 'name') ?>)</a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>login.php" class="btn btn-primary me-2">Log in</a>
                        <a href="<?= BASE_URL ?>register.php" class="btn btn-outline-light">Register</a>

                    <?php endif; ?>
            </div>

        </div>
    </nav>

    <?= $content ?>

</body>
</html>