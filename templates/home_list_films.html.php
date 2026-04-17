<?php
$body_class = 'home-page'; 
?>

<style>
    .btn-xam-den {
        background-color: #343a40; 
        color: #f8f9fa; 
        border: 1px solid #495057; 
    }
    
    .btn-xam-den:hover {
        background-color: #212529; 
        color: #ffffff;
        border-color: #343a40;
    }
</style>

<div class="container">
    <h2 class="text-sp">
        Superhero repository
    </h2>

    <?php
    $current_category = isset($_GET['category']) ? $_GET['category'] : 'all';
    ?>
    <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-center flex-wrap gap-2">
            <a href="list_films.php?category=all" 
               class="filter-btn <?= $current_category === 'all' ? 'active' : '' ?>" style="text-decoration: none;">All</a>
           
            <a href="list_films.php?category=Kamen Rider" 
               class="filter-btn <?= $current_category === 'Kamen Rider' ? 'active' : '' ?>" style="text-decoration: none;">Kamen Rider</a>
           
            <a href="list_films.php?category=Super Sentai" 
               class="filter-btn <?= $current_category === 'Super Sentai' ? 'active' : '' ?>" style="text-decoration: none;">Super Sentai</a>
           
            <a href="list_films.php?category=Ultraman" 
               class="filter-btn <?= $current_category === 'Ultraman' ? 'active' : '' ?>" style="text-decoration: none;">Ultraman</a>
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($films)): ?>
            <?php foreach ($films as $film): ?>
                
                <div class="col-12 col-md-4 col-lg-3 mb-4">
                    
                    <div class="card h-100 film-card text-white shadow-sm">

                        <img src="uploads/<?= htmlspecialchars($film['images']) ?>" alt="Poster of <?= htmlspecialchars($film['title']) ?>"  width="100"
                        class="card-img-top"
                        style="height: 350px; object-fit: cover;">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-danger"><?= htmlspecialchars($film['category_name'] ?? '') ?></span>
                                
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <div>
                                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>

                                            <a href="<?= BASE_URL ?>admin/edit_film.php?id=<?= $film['id'] ?>" class="btn btn-xam-den btn-sm fw-bold me-1 shadow-sm text-decoration-none px-2">Edit</a>

                                            <a href="<?= BASE_URL ?>admin/delete_film.php?id=<?= $film['id'] ?>" class="btn btn-xam-den btn-sm fw-bold shadow-sm text-decoration-none px-2" onclick="return confirm('Administrator privileges: Are you sure you want to remove this movie from the system?');">Delete</a>
                                            
                                        <?php elseif ($_SESSION['user_id'] == $film['user_id']): ?>

                                            <a href="<?= BASE_URL ?>user/edit_film.php?id=<?= $film['id'] ?>" class="btn btn-secondary btn-sm fw-bold text-white me-1 shadow-sm text-decoration-none px-2">Edit</a>

                                            <a href="<?= BASE_URL ?>user/delete_film.php?id=<?= $film['id'] ?>" class="btn btn-secondary btn-sm fw-bold text-white shadow-sm text-decoration-none px-2" onclick="return confirm('Are you sure you want to delete this movie? This action cannot be undone.');">Delete</a>
                                            
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <h5 class="card-title fw-bold text-truncate">
                                <?= htmlspecialchars($film['title']) ?>
                            </h5>

                            <p class="card-text small text-black fw-bold">
                                Posted by: <?= htmlspecialchars($film['uploader_name']) ?>
                            </p>
                        </div>

                        <div class="card-footer border-0 bg-transparent text-center pb-3">
                            <a href="review.php?id=<?= $film['id'] ?>"
                               class="btn btn-outline-warning w-100 fw-bold">
                                Go to Rate & Review
                            </a>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center mt-5">
                <h4 class="text-white">
                    No films available for review!
                </h4>
            </div>
        <?php endif; ?>
    </div>
</div>