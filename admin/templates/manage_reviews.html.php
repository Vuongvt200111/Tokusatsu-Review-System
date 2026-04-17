<div class="card admin-card p-4 border-top border-4 border-warning shadow-lg">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-warning fw-bold m-0">REVIEWS MANAGEMENT</h3>
        <span class="badge bg-warning text-dark fs-6">Total: <?= count($reviews) ?> reviews have been submitted.</span>
    </div>

    <?= $msg_alert ?>

    <div class="table-responsive shadow rounded">
        <table class="table table-dark table-hover table-bordered align-middle border-secondary m-0">
            <thead class="table-secondary text-dark">
                <tr>
                    <th class="text-center" width="5%">ID</th>
                    <th width="20%">The film was reviewed</th>
                    <th width="15%">Reviewer</th>
                    <th width="45%">Content & Rating</th>
                    <th class="text-center" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($reviews)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-secondary py-5 fw-bold fs-5">
                            No reviews have been submitted yet...
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reviews as $rv): ?>
                    <tr>
                        <td class="text-center fw-bold text-light"><?= htmlspecialchars($rv['id']) ?></td>
                        
                        <td class="fw-bold text-info">
                            <?= htmlspecialchars($rv['film_title'] ?? 'The film has been deleted') ?>
                        </td>
                        
                        <td>
                            <div class="fw-bold text-warning">
                                <?= htmlspecialchars($rv['user_name'] ?? '') ?>
                            </div>
                            <div class="text-secondary small mt-1">
                                <?= isset($rv['created_at']) ? date('d/m/Y H:i', strtotime($rv['created_at'])) : '' ?>
                            </div>
                        </td>
                        
                        <td>
                            <div class="text-warning mb-2 fs-6">
                                <?php 
                                    $rating = (int)($rv['rating'] ?? 0);
                                    for($i=1; $i<=5; $i++) {
                                        echo $i <= $rating ? '★' : '☆';
                                    }
                                ?>
                                <span class="text-light ms-2 badge bg-secondary"><?= $rating ?>/5</span>
                            </div>
                            <div class="p-2 bg-dark bg-opacity-50 rounded text-light border-start border-3 border-warning" style="max-height: 80px; overflow-y: auto;">
                                <?= nl2br(htmlspecialchars($rv['content'])) ?>
                            </div>
                        </td>

                        <td class="text-center">
                            <form method="POST" action="" onsubmit="return confirm('Are you sure you want to PERMANENTLY DELETE this review, Admin?');">
                                <input type="hidden" name="delete_id" value="<?= $rv['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger fw-bold neon-border w-100 shadow-sm py-2">
                                    Delete Review
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-secondary fw-bold shadow-sm">
            &#8592; Back to Dashboard
        </a>
    </div>
</div>