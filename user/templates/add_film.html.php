<link rel="stylesheet" href="../css/user_add_film.css">
<div class="add-film-wrapper">
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-10 col-lg-8">
                
                <div class="card add-film-card">
                    <div class="add-film-header">
                        <?= htmlspecialchars($page_title) ?>
                    </div>
                    
                    <div class="card-body">
                        
                        <?php if ($error): ?> 
                            <div class="alert alert-danger py-2 fw-bold"><?= htmlspecialchars($error) ?></div> 
                        <?php endif; ?>
                        
                        <?php if ($success): ?> 
                            <div class="alert alert-success py-2 fw-bold"><?= htmlspecialchars($success) ?></div> 
                        <?php endif; ?> 

                        <form action="add_film.php" method="POST" enctype="multipart/form-data">
                            
                            <div>
                                <label class="add-film-label">Film Title:</label>
                                <input type="text" name="title" class="form-control add-film-input" 
                                       value="<?= htmlspecialchars($film['title'] ?? '') ?>" required>
                            </div>

                            <div>
                                <label class="add-film-label">Category:</label>
                                <select name="category_id" class="form-select add-film-input" required>
                                    <option value="">-- Select Category --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat['id']) ?>">
                                            <?= htmlspecialchars($cat['category_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div>
                                <label class="add-film-label">Poster Image:</label>
                                <input type="file" name="image" class="form-control add-film-input" accept="image/*" required>
                            </div>

                            <div>
                                <label class="add-film-label">Film Introduction (Description):</label>
                                <textarea name="description" class="form-control add-film-input" rows="6" required><?= htmlspecialchars($film['description'] ?? '') ?></textarea>
                            </div>

                            <button type="submit" name="user_id" class="btn btn-warning fw-bold w-100 fs-5 mt-3 shadow"> POST FILM</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>