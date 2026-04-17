<link rel="stylesheet" href="<?= BASE_URL ?>css/profile.css">
    <div class="profile-container">
        <h2 class="profile-title">ACCOUNT INFORMATION</h2>
        <div class="profile-layout">
        <div class="profile-card">
            <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($userInfo['avatar'] ?? 'default_avatar.jpg') ?>" alt="Avatar of <?= htmlspecialchars($userInfo['name'])?>"
                 class="avatar">

            <h4 class="username"><?= htmlspecialchars($userInfo['name']) ?></h4>

            <?php if ($userInfo['role'] == 1): ?>
                <span class="badge admin">Administrator</span>
            <?php else: ?>
                <span class="badge bg-success p-2 fs-6">Member</span>
                <?php endif; ?>

            <!-- <p class="status text-black fw-bold">
                Status:
                <span class="<?= ($userInfo['status'] == 'active') ? 'active' : 'onbreak' ?>">
                    <?= strtoupper($userInfo['status'] ?? 'ACTIVE') ?> 
                </span>
            </p> -->

            <?php if ($userInfo['role'] != 1): ?>
                <div class="delete-box">
                    <a href="<?= BASE_URL ?>user/delete_account.php" class="btn-delete"
                       onclick="return confirm('Are you sure you want to delete your account?');">
                       Delete account
                    </a>
                </div>
            <?php endif; ?>

        </div>

        <div class="profile-form fw-bold">

            <h4>Profile Setting</h4>

            <?php if (!empty($error)): ?>
                <div class="alert error"><?= $error ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert success"><?= $success ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>profile.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                    <label class="text-info fw-bold mb-1">Change Name</label>
                    <input type="text" name="name"
                        value="<?= htmlspecialchars($userInfo['name'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label class="text-info fw-bold mb-1">Avatar</label>
                    <input type="file" name="avatar">
                </div>

                <div class="form-group">
                    <label class="text-info fw-bold mb-1">Favorite Tokusatsu genre</label>
                    <select name="favorite_genre" class="form-control">
                        <option value="">-- Select Genre --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= (isset($userInfo['favorite_genre']) && $userInfo['favorite_genre'] == $cat['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-info fw-bold mb-1">Bio</label>
                    <textarea name="bio" maxlength="500"><?= htmlspecialchars($userInfo['bio'] ?? '') ?></textarea>
                </div>

                <!-- <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="active" <?= ($userInfo['status'] == 'active') ? 'selected' : '' ?>>Active</option>
                        <option value="on_break" <?= ($userInfo['status'] == 'on_break') ? 'selected' : '' ?>>On Break</option>
                    </select>
                </div> -->

                <button type="submit" name="update_profile" class="btn-update">
                    UPDATE PROFILE
                </button>

            </form>
        </div>

    </div>
</div>
