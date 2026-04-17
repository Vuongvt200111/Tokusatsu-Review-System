<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Setup Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light" style="background-image: url('uploads/11.png'); background-size: cover;">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card bg-dark bg-opacity-75 border-danger shadow-lg">
                    <div class="card-header bg-danger text-center text-white fw-bold fs-5">
                        SETUP ADMIN
                    </div>
                    <div class="card-body p-4">
                        <?php if($error): ?> <div class="alert alert-danger py-2"><?= $error ?></div> <?php endif; ?>
                        
                        <?php if($success): ?>
                            <div class="alert alert-success py-2"><?= $success ?></div>
                            <a href="login.php" class="btn btn-warning w-100 fw-bold">Go to Login</a>
                        <?php else: ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label text-warning fw-bold">Boss Name:</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Boss Name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-warning fw-bold">Email Admin:</label>
                                    <input type="email" name="email" class="form-control" placeholder="admin@tokusatsu.com" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-warning fw-bold">Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-danger w-100 fw-bold">Establishing power</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>