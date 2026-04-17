<div class="card admin-card p-4 border-top border-4 border-warning shadow-lg">
    <h3 class="text-warning fw-bold mb-4">FILM APPROVAL WAITING LIST</h3>
    
    <?= $msg ?? '' ?>

    <table class="table table-dark table-hover table-bordered align-middle">
        <thead class="table-secondary text-dark">
            <tr>
                <th>Film Title</th>
                <th>Uploader</th>
                <th>Image</th>
                <th>Short Description</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($pending_films)): ?>
                <tr><td colspan="5" class="text-center py-4">No films are currently waiting for approval.</td></tr>
            <?php else: ?>
                <?php foreach ($pending_films as $film): ?>
                <tr>
                    <td class="text-info fw-bold"><?= htmlspecialchars($film['title']) ?></td>
                    <td class="fw-bold text-warning" ><?= htmlspecialchars($film['uploader_name']) ?></td>

                    <td>
                        <?php if ($film['images']): ?>
                            <img src="../uploads/<?= htmlspecialchars($film['images']) ?>" width="150" class="rounded border border-secondary">
                        <?php else: ?>
                            <span class="text-secondary">No image</span>
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars(substr($film['description'], 0, 50)) ?></td>

                    <td class="text-center">
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="film_id" value="<?= $film['id'] ?>">
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="btn btn-sm btn-success fw-bold">Approve</button>
                        </form>
                        
                        <form method="POST" class="d-inline" onsubmit="return confirm('Do you definitely want to cancel this film?');">
                            <input type="hidden" name="film_id" value="<?= $film['id'] ?>">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="btn btn-sm btn-danger fw-bold">Refuse</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-secondary fw-bold shadow-sm">
            &#8592; Back to Dashboard
        </a>
    </div>
</div>