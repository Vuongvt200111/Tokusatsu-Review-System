<link rel="stylesheet" href="<?= BASE_URL ?>css/admin_edit_film.css">

<div class="admin-update-wrapper">
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-8 col-lg-6"> 
                
                <div class="card admin-update-card">
                    <div class="admin-update-header">
                        <?= $page_title ?>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">

                        <?php if ($error): ?> 
                            <div class="alert alert-warning fw-bold py-2"><?= $error ?></div> 
                        <?php endif; ?>

                        <form action="<?= $action_url ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-1">
                            <input type="hidden" name="film_id" value="<?= $film['id'] ?>">

                            <div class="mb-1">
                                <label class="admin-update-label text-info text-warning">Film Title:</label>
                                <input type="text" name="title" class="form-control admin-update-input" 
                                       value="<?= htmlspecialchars($film['title']) ?>" required>
                            </div>
                            
                            <div class="mb-1">
                                <label class="admin-update-label text-info text-warning">Category:</label>
                                <select name="category_id" class="form-select admin-update-input" required>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= ($film['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['category_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="mb-1">
                                <label class="admin-update-label text-info text-warning">New Poster Image (leave blank to keep current):</label>
                                <input type="file" name="image" class="form-control admin-update-input" accept="image/*">
                                
                                <div class=" text-center rounded current-poster-box">
                                    <small class="text-black fw-bold d-block mb-2">Current Poster:</small>
                                    <img src="<?= BASE_URL ?>uploads/<?= $film['images'] ?>" width="200" class="img-thumbnail shadow-sm">
                                </div>
                            </div>
                            
                            <div class="mb-1">
                                <label class="admin-update-label text-info text-warning">Detailed Description:</label>
                                <textarea name="description" class="form-control admin-update-input" rows="5" required><?= htmlspecialchars($film['description']) ?></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 fw-bold fs-5 mt-3 shadow">
                                UPDATE FILM
                            </button>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>