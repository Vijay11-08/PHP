<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');

$pageTitle = "Companies";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Participating Companies</h1>
</div>

<?php
// Fetch all approved companies
$stmt = $pdo->query("SELECT * FROM users WHERE role='company' AND status='approved' ORDER BY full_name ASC");
$companies = $stmt->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Joined Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($companies as $company): ?>
                <tr>
                    <td>
                        <div style="display:flex; align-items:center;">
                            <div style="width:40px; height:40px; background:#eee; border-radius:50%; display:flex; align-items:center; justify-content:center; margin-right:10px; font-weight:bold;">
                                <?php echo strtoupper(substr($company['full_name'], 0, 1)); ?>
                            </div>
                            <?php echo htmlspecialchars($company['full_name']); ?>
                        </div>
                    </td>
                    <td><a href="mailto:<?php echo htmlspecialchars($company['email']); ?>"><?php echo htmlspecialchars($company['email']); ?></a></td>
                    <td><?php echo date('M d, Y', strtotime($company['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($companies)): ?>
                    <tr><td colspan="3" class="text-center">No companies registered yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
