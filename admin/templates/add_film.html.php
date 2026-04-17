<link rel="stylesheet" href="<?= BASE_URL ?>css/admin_add_film.css">
<div class="admin-add-film-wrapper">
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-10 col-lg-8">
                
                <div class="card admin-card">
                    <div class="admin-card-header">
                        <?= $page_title ?>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        
                        <?php if ($error): ?> 
                            <div class="alert alert-warning fw-bold py-2"><?= $error ?></div> 
                        <?php endif; ?>

                        <form action="<?= $action_url ?>" method="POST" enctype="multipart/form-data">
                            
                            <div>
                                <label class="admin-label text-info neon-text">Film Title:</label>
                                <input type="text" name="title" class="form-control admin-input" required>
                            </div>
                            
                            <div>
                                <label class="admin-label text-info neon-text">Category:</label>
                                <select name="category_id" class="form-select admin-input" required>
                                    <option value="">-- Select Category --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label class="admin-label text-info neon-text">Poster Image:</label>
                                <input type="file" name="image" class="form-control admin-input" accept="image/*" required>
                            </div>
                            
                            <div>
                                <label class="admin-label text-info">Detailed Description:</label>
                                <textarea name="description" class="form-control admin-input" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-danger w-100 fw-bold fs-5 mt-3 shadow">
                                SAVE NEW FILM
                            </button>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>