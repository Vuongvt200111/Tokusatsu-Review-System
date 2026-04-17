<?php if(isset($error) && $error): ?> 
    <div class="alert alert-danger fw-bold text-center shadow"><?= $error ?></div> 
<?php endif; ?>

<div class="row mb-5">
    <div class="col-md-4 mb-3">
        <div class="card admin-card h-100 p-4 text-center border-top border-4 border-warning">
            <h5 class="text-warning fw-bold mb-3">FILMS LIST</h5>
            <h1 class="display-3 text-white fw-bold"><?= $totalFilms ?? 0 ?></h1>
            <p class="text-white mb-4">Total number of films</p>
            <a href="../list_films.php" class="btn btn-outline-warning w-100 mt-auto">Manage Films</a>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card admin-card h-100 p-4 text-center border-top border-4 border-success">
            <h5 class="text-success fw-bold mb-3">REVIEWS LIST</h5>
            <h1 class="display-3 text-white fw-bold"><?= $totalReviews ?? 0 ?></h1>
            <p class="text-white mb-4">Total number of reviews</p>
            <a href="manage_reviews.php" class="btn btn-outline-success w-100 mt-auto">Manage Reviews</a>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card admin-card h-100 p-4 text-center border-top border-4 border-info">
            <h5 class="text-info fw-bold mb-3">USERS LIST</h5>
            <h1 class="display-3 text-white fw-bold"><?= $totalUsers ?? 0 ?></h1>
            <p class="text-white mb-4">Total number of users</p>
            <a href="manage_users.php" class="btn btn-outline-info w-100 mt-auto">Manage Accounts</a>
        </div>
    </div>
</div>


<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card admin-card p-4 text-center border-secondary">
            <h4 class="text-light mb-4">EXCLUSIVE FEATURES</h4>
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <?php 
                if (isset($_SESSION['email']) && $_SESSION['email'] === 'admin@tokusatsu.com'): 
                ?>
                <a href="add_new_admin.php" class="btn btn-primary px-4 shadow">
                    Grant administrator account
                </a>
                <?php endif; ?>
                <a href="approve_films.php" class="btn btn-warning px-4 shadow">
                    Approve pending films
                </a>

                <a href="messages.php" class="btn btn-success px-4 shadow">
                    View Messages
                </a>
            </div>
        </div>
    </div>
</div>