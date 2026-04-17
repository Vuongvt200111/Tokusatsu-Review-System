<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body class="admin-body">

    <nav class="navbar navbar-expand-lg navbar-dark admin-navbar shadow-lg mb-5">
        <div class="container-fluid px-4">
            <a class="navbar-brand text-danger fw-bold fs-4 neon-text" href="dashboard.php">
                 MANAGE THE ENTIRE SYSTEM
            </a>
            
            <div class="d-flex align-items-center gap-4 ms-auto">
                <div class="user-badge">
                    <span class="text-white fw-bold small d-block" style="line-height: 1;">Logged in as:</span>
                    <span class="text-warning fw-bold fs-6">
                        <?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['email']) ?>
                    </span>
                </div>
                
                <a href="../list_films.php" class="btn btn-outline-info btn-sm fw-bold neon-border">
                    🌐 Go to the web user
                </a>
                <a href="../logout.php" class="btn btn-danger btn-sm fw-bold shadow-danger">
                    ⏻ Log out
                </a>
            </div>
        </div>
    </nav>

    <main class="container admin-main-content">
        <?= $content ?>
    </main>

    <footer class="text-center text-white mt-5 pb-3">
        <small>© 2026 Tokusatsu Universe - Admin Control Panel.</small>
    </footer>

</body>
</html>