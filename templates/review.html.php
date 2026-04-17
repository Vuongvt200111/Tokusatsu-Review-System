<style>
    header, .navbar, nav, #navbar {
        display: none !important;
    }
    
    body {
        padding-top: 0 !important; 
    }
</style>
<div class="netflix-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6)), url('uploads/<?= htmlspecialchars($film['images']) ?>');">
    <div class="overlay-bg-custom">
        <div class="container mb-4 pt-3">
            <a href="list_films.php" class="btn btn-outline-danger fw-bold"><- Back to List</a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <div class="card film-info-card bg-dark bg-opacity-75 p-3 border-secondary rounded">
                        <img src="uploads/<?= htmlspecialchars($film['images']) ?>" class="img-fluid rounded shadow-lg border border-secondary" alt="Poster of <?= htmlspecialchars($film['title']) ?>">
                        <div class="mt-3">
                            <span class="badge bg-danger fs-6 mb-2"><?= htmlspecialchars($film['category_name']) ?></span>
                            <h1 class="text-warning fw-bold"><?= htmlspecialchars($film['title']) ?></h1>
                            
                            <p class="text-light mb-1">Post by: <?= htmlspecialchars($film['uploader_name']) ?></p>
                            <p class="text-info fw-bold small mb-2">Date posted: <?= date('d/m/Y H:i', strtotime($film['created_at'])) ?></p>
                            
                            <hr class="border-secondary">
                            <h5 class="text-light">Introduction:</h5>
                            <p class="text-light" style="line-height: 1.8; text-align: justify;">
                                <?= nl2br(htmlspecialchars($film['description'])) ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <h3 class="text-warning mb-4 border-bottom border-warning pb-2">COMMUNITY REVIEWS</h3>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="card bg-dark bg-opacity-75 text-white border-secondary mb-5 shadow">
                            <div class="card-body">
                                <h5 class="card-title text-info mb-3">Write Your Review</h5>
                                
                                <?php if ($error): ?> <div class="alert alert-danger py-2"><?= $error ?></div> <?php endif; ?>
                                <?php if ($success): ?> <div class="alert alert-success py-2"><?= $success ?></div> <?php endif; ?>

                                <form action="user/add_review.php" method="POST">
                                    <input type="hidden" name="film_id" value="<?= htmlspecialchars($film['id']) ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Rate this film:</label>
                                        <select name="rating" class="form-select bg-secondary text-white border-0 w-auto" required>
                                            <option value="5">⭐⭐⭐⭐⭐ (5 Stars - Masterpiece)</option>
                                            <option value="4">⭐⭐⭐⭐ (4 Stars - Very Good)</option>
                                            <option value="3" selected>⭐⭐⭐ (3 Stars - Fair)</option>
                                            <option value="2">⭐⭐ (2 Stars - Below Average)</option>
                                            <option value="1">⭐ (1 Star - Poor)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control bg-secondary text-white border-0" rows="3" minlength="1" maxlength="1000" placeholder="Is this film good/bad..." required></textarea>
                                    </div>
                                    <button type="submit" name="submit_review" class="btn btn-warning fw-bold text-dark">Submit a Review</button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-secondary bg-dark bg-opacity-75 text-light border-secondary">
                            Please <a href="login.php" class="text-warning text-decoration-none fw-bold">log in</a> to write a review.
                        </div>
                    <?php endif; ?>

                    <div class="reviews-list">
                        <?php if (count($reviews) > 0): ?>
                            <?php foreach ($reviews as $rev): ?>
                                <div class="card bg-dark bg-opacity-75 text-white border-secondary mb-3 shadow-sm">
                                    <div class="card-body p-3">
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom border-secondary pb-2">
                                            <span class="reviewer-name text-warning fw-bold">
                                                <?= htmlspecialchars($rev['reviewer_name']) ?>
                                            </span>
                                            
                                            <div class="d-flex align-items-center">
                                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1): ?>
                                                    <a href="<?= BASE_URL ?>admin/delete_review.php?id=<?= $rev['id'] ?>&film_id=<?= $film['id'] ?>" 
                                                       class="badge bg-danger text-white text-decoration-none me-3 p-1 shadow-sm"
                                                       onclick="return confirm('Administrator: Are you sure you want to delete this review?');">
                                                       Delete (Admin)
                                                    </a>

                                                <?php elseif (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $rev['user_id']): ?>
                                                    <a href="user/edit_review.php?id=<?= $rev['id'] ?>" 
                                                       class="badge bg-primary text-white text-decoration-none me-2 p-1 shadow-sm">
                                                       Edit
                                                    </a>
                                                    <a href="user/delete_review.php?id=<?= $rev['id'] ?>&film_id=<?= $film['id'] ?>" 
                                                       class="badge bg-danger text-white text-decoration-none me-3 p-1 shadow-sm"
                                                       onclick="return confirm('Are you sure you want to delete your review?');">
                                                       Delete
                                                    </a>
                                                <?php endif; ?>
                                                
                                                <span class="text-info small fw-bold">
                                                    <?= date('d/m/Y H:i', strtotime($rev['created_at'])) ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="star-rating mb-2">
                                            <?= str_repeat('⭐', $rev['rating']) ?>
                                        </div>
                                        
                                        <p class="mb-0 text-light" style="line-height: 1.6; text-align: justify;">
                                            <?= nl2br(htmlspecialchars($rev['content'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-secondary bg-dark bg-opacity-75 text-light border-secondary">
                                No reviews yet. Be the first!
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>