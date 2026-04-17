<div class="card admin-card p-4 border-top border-4 border-info shadow-lg">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-info fw-bold m-0">MANAGE SYSTEM ACCOUNTS</h3>
        <span class="badge bg-info text-dark fs-6 px-3">System has recorded: <?= count($users) ?> accounts</span>
    </div>

    <?php if(isset($_GET['status']) && $_GET['status'] == 'restored'): ?>
        <div class="alert alert-success fw-bold border-0 shadow-sm">Account restored successfully!</div>
    <?php endif; ?>

    <?php if($message): ?> 
        <div class="alert alert-warning alert-dismissible fade show fw-bold shadow-sm">
            <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div> 
    <?php endif; ?>

    <div class="table-responsive rounded shadow-sm">
        <table class="table table-dark table-hover table-bordered align-middle border-secondary m-0 text-center">
            <thead class="table-secondary text-dark fw-bold">
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Display Name</th>
                    <th width="20%">Email</th>
                    <th width="15%">Join Date</th>
                    <th width="10%">Role</th>
                    <th width="15%">Status</th>
                    <th width="20%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr><td colspan="7" class="text-center text-secondary py-5 fw-bold">No data available.</td></tr>
                <?php else: ?>
                    <?php foreach ($users as $u): ?>
                    <tr class="<?= ($u['is_deleted'] == 1) ? 'opacity-100' : '' ?>">
                        <td class="fw-bold"><?= $u['id'] ?></td>
                        <td class="text-warning fw-bold"><?= htmlspecialchars($u['name'] ?? 'No name') ?></td>
                        <td class="small text-light"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="text-secondary small">
                            <?= isset($u['created_at']) ? date('d/m/Y H:i', strtotime($u['created_at'])) : 'N/A' ?>
                        </td>
                        
                        <td>
                            <?php if ($u['role'] == 1 || $u['role'] === 'admin'): ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php else: ?>
                                <span class="badge bg-primary">Reviewer</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if ($u['is_deleted'] == 1): ?>
                                <span class="badge bg-secondary">Deleted (Soft)</span>
                            <?php else: ?>
                                <span class="badge bg-success">Active</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="d-flex flex-column gap-2 justify-content-center align-items-center">
                                
                                <?php if ($u['is_deleted'] == 1): ?>
                                    <a href="restore_user.php?id=<?= $u['id'] ?>" 
                                       class="btn btn-sm btn-success fw-bold shadow-sm w-100"
                                       onclick="return confirm('How to reactivate access for this account?');">
                                        Restore Access
                                    </a>
                                <?php endif; ?>

                                <?php 
                                    $current_admin_id = $_SESSION['user_id'];
                                    $is_target_admin = ($u['role'] == 1 || $u['role'] === 'admin');

                                    if ($u['id'] == 1):
                                ?>
                                    <span class="badge bg-warning text-dark w-100 py-2">Boss</span>

                                <?php 
                                    elseif ($current_admin_id == 1 || $u['id'] == $current_admin_id || !$is_target_admin): 
                                ?>
                                <form method="POST" action="" class="w-100" onsubmit="return confirm('<?= ($u['id'] == $current_admin_id) ? 'SEVERE WARNING: The admin is DELETING HIMSELF! Account will be permanently deleted and logged out immediately!' : 'The admin definitely wants to EXECUTE this account? The action cannot be reversed!' ?>');">
                                    <input type="hidden" name="delete_id" value="<?= $u['id'] ?>">
                                    <button type="submit" class="btn btn-sm <?= ($u['id'] == $current_admin_id) ? 'btn-danger' : 'btn-outline-danger' ?> w-100 py-1" style="font-size: 0.75rem;">
                                        <?= ($u['id'] == $current_admin_id) ? 'Self-erasure' : 'Permanently delete' ?>
                                    </button>
                                </form>

                                <?php 
                                    else: 
                                ?>
                                    <span class="text-white small italic">Not authorized</span>
                                <?php endif; ?>

                            </div>
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