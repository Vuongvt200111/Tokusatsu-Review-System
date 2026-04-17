<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card admin-card p-4 border-top border-4 border-primary">
            <h3 class="text-primary fw-bold mb-4 text-center">GRANT NEW ADMIN PRIVILEGES</h3>
            
            <?php if($error): ?> <div class="alert alert-danger shadow fw-bold"><?= $error ?></div> <?php endif; ?>
            <?php if($success): ?> <div class="alert alert-success shadow fw-bold"><?= $success ?></div> <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="text-light fw-bold mb-1 neon-text">Name</label>
                    <input type="text" name="name" class="form-control bg-dark text-light border-secondary shadow-sm" required placeholder="Enter Admin's name...">
                </div>
                <div class="mb-3">
                    <label class="text-light fw-bold mb-1 neon-text">Email</label>
                    <input type="email" name="email" class="form-control bg-dark text-light border-secondary shadow-sm" required placeholder="admin@tokusatsu.com">
                </div>
                <div class="mb-4">
                    <label class="text-light fw-bold mb-1 neon-text">Password</label>
                    <input type="password" name="password" class="form-control bg-dark text-light border-secondary shadow-sm" required placeholder="********">
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold shadow-lg p-2 neon-border">
                     CREATE
                </button>
            </form>
            
            <div class="mt-4 text-center">
                <a href="dashboard.php" class="text-white btn btn-secondary fw-bold shadow-sm">
                     &#8592; Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>