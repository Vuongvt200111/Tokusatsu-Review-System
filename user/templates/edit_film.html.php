<link rel="stylesheet" href="<?= BASE_URL ?>css/user_edit_film.css">
<div class="user-edit-wrapper">
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            
            <div class="col-md-8 col-lg-6">
                
                <div class="card user-edit-card text-white">
                    <div class="card-header bg-warning text-dark fw-bold fs-5 text-center border-0">
                        <?= htmlspecialchars($page_title) ?>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php if ($error): ?> 
                            <div class="alert alert-danger py-2 fw-bold text-center"><?= htmlspecialchars($error) ?></div> 
                        <?php endif; ?> 
                        
                        <?php if ($success): ?> 
                            <div class="alert alert-success py-2 fw-bold text-center"><?= htmlspecialchars($success) ?></div> 
                        <?php endif; ?>

                        <form action="edit_film.php" method="POST" enctype="multipart/form-data">
                            <?php if (isset($film_id)): ?>
                                <input type="hidden" name="film_id" value="<?= htmlspecialchars($film_id) ?>">
                            <?php endif; ?>

                            <div class="mb-4">
                                <label class="text-info fw-bold mb-2">Film Title:</label>
                                <input type="text" name="title" class="form-control user-edit-input" 
                                       value="<?= htmlspecialchars($film['title'] ?? '') ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="text-info fw-bold mb-2">Category:</label>
                                <select name="category_id" class="form-select user-edit-input" required>
                                    <option value="" class="text-dark">-- Select Category --</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat['id']) ?>" class="text-dark"
                                                <?= (isset($film['category_id']) && $film['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['category_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="text-info fw-bold mb-2">Poster Image:</label>
                                <input type="file" name="image" class="form-control user-edit-input" 
                                       accept="image/*" <?= !isset($film['images']) ? 'required' : '' ?>>
                                
                                <?php if (isset($film['images']) && $film['images']): ?>
                                    <div class="mt-3 p-3 text-center border rounded" style="background-color: rgba(0,0,0,0.3); border-color: rgba(255,255,255,0.1) !important;">
                                        <small class="text-warning fw-bold d-block mb-2">Current Image:</small>
                                        <img src="../uploads/<?= htmlspecialchars($film['images']) ?>" 
                                             width="200" class="rounded shadow-sm">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-4">
                                <label class="text-info fw-bold mb-2">Film Introduction (Description):</label>
                                <textarea name="description" class="form-control user-edit-input" 
                                          rows="5" required><?= htmlspecialchars($film['description'] ?? '') ?></textarea>
                            </div>

                            <button type="submit" name="submit_film" class="btn btn-warning fw-bold w-100 fs-5 mt-2 shadow">
                                UPDATE INFORMATION
                            </button>
                        </form>
                        
                        </div>
                </div>
                
            </div>
        </div>
    </div>
</div>