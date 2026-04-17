<link rel="stylesheet" href="../css/user_edit_review.css">

<style>
    nav, header, .navbar {
        display: none !important;
    }
    .netflix-bg {
        background-image: url('uploads/<?= htmlspecialchars($film['images'] ?? $film['image']) ?>');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        min-height: 100vh; 
        padding-top: 20px;
    }
    
    .overlay-bg-custom {
        background-color: rgba(0, 0, 0, 0.7);
        min-height: 100vh;
        padding-bottom: 50px;
    }
</style>

<div class="edit-review-wrapper">
    
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-10 col-lg-6"> 
                
                <h2 class="edit-review-title">Edit Your Review</h2>
                
                <div class="card edit-review-card">
                    <div class="card-body edit-review-card-body">
                        <?php if ($error): ?> 
                        <div class="alert alert-danger py-2"><?= $error ?></div> 
                    <?php endif; ?>
                    
                    <form action="" method="POST">
                        <input type="hidden" name="review_id" value="<?= htmlspecialchars($review['id']) ?>">
                        
                        <div class="mb-4">
                            <label class="form-label edit-review-label">Rating:</label>
                            <select name="rating" class="form-select edit-review-input w-auto" required>
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <option value="<?= $i ?>" <?= ($review['rating'] == $i) ? 'selected' : '' ?>>
                                        <?= str_repeat('⭐', $i) ?> (<?= $i ?> Sao)
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label edit-review-label">Content:</label>
                            <textarea name="content" class="form-control edit-review-input" rows="5" required><?= htmlspecialchars($review['content']) ?></textarea>
                        </div>
                        
                        <button type="submit" name="update_review" class="btn btn-warning fw-bold text-dark px-4">Update Review</button>
                        <a href="../review.php?id=<?= $film_id ?>" class="btn btn-outline-light ms-3">Cancel & Go Back</a>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>