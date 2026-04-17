<div class="card admin-card p-4 border-top border-4 border-success shadow-lg">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-success fw-bold m-0">MANAGE MESSAGE & CUSTOMER SUPPORT</h3>
        <span class="badge bg-success text-dark fs-6">Total: <?= count($messages) ?> Messages</span>
    </div>

    <?= $msg_alert ?>

    <div class="table-responsive shadow rounded">
        <table class="table table-dark table-hover table-bordered align-middle border-secondary m-0">
            <thead class="table-secondary text-dark">
                <tr>
                    <th class="text-center" width="5%">ID</th>
                    <th width="15%">Sender</th>
                    <th width="30%">Message Content (Reviewer)</th>
                    <th width="35%">Admin Response</th>
                    <th class="text-center" width="15%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr><td colspan="5" class="text-center text-secondary py-5 fw-bold fs-5">Message box is empty.</td></tr>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                    <tr>
                        <td class="text-center fw-bold"><?= htmlspecialchars($msg['id']) ?></td>
                        <td>
                            <div class="fw-bold text-warning"><?= htmlspecialchars($msg['name'] ?? 'Account deleted') ?></div>
                            <div class="text-info small"><?= htmlspecialchars($msg['email'] ?? '') ?></div>
                            <div class="text-secondary small mt-1" style="font-size: 0.75rem;">
                                <?= isset($msg['created_at']) ? date('d/m/Y H:i', strtotime($msg['created_at'])) : '' ?>
                            </div>
                        </td>
                        
                        <td>
                            <div class="p-2 bg-secondary bg-opacity-25 rounded text-light border-start border-3 border-warning">
                                <?= nl2br(htmlspecialchars($msg['user_message'])) ?>
                            </div>
                        </td>

                        <td>
                            <?php if ($msg['status'] == 'pending'): ?>
                                <form method="POST" action="">
                                    <input type="hidden" name="reply_id" value="<?= $msg['id'] ?>">
                                    <textarea name="admin_reply" rows="2" class="form-control form-control-sm bg-dark text-light border-info mb-2" placeholder="Enter your reply..." required></textarea>
                                    <button type="submit" class="btn btn-sm btn-info fw-bold w-100">Send Feedback</button>
                                </form>
                            <?php else: ?>
                                <div class="p-2 bg-success bg-opacity-10 rounded text-light border-start border-3 border-success mb-2">
                                    <span class="text-success fw-bold small">You have answered:</span><br>
                                    <?= nl2br(htmlspecialchars($msg['admin_reply'])) ?>
                                </div>
                                <div class="text-secondary small text-end">
                                    Time: <?= isset($msg['updated_at']) ? date('d/m/Y H:i', strtotime($msg['updated_at'])) : '' ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <?php if ($msg['status'] == 'pending'): ?>
                                <span class="badge bg-warning text-dark mb-2 d-block shadow-sm">Pending</span>
                            <?php else: ?>
                                <span class="badge bg-success mb-2 d-block shadow-sm">Replied</span>
                            <?php endif; ?>
                            
                            <form method="POST" action="" onsubmit="return confirm('Delete this message from the database?');">
                                <input type="hidden" name="delete_id" value="<?= $msg['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger fw-bold neon-border w-100 shadow-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        <a href="dashboard.php" class="btn btn-secondary fw-bold shadow-sm">&#8592; Back to Dashboard</a>
    </div>
</div>