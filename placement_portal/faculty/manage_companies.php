<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$pageTitle = "Manage Companies";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Manage Companies</h1>
</div>

<?php
// Handle Actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    if ($action == 'approve') {
        $pdo->prepare("UPDATE users SET status='approved' WHERE id=?")->execute([$id]);
    } elseif ($action == 'reject') {
        $pdo->prepare("UPDATE users SET status='rejected' WHERE id=?")->execute([$id]);
    } 
    echo "<script>window.location.href='manage_companies.php';</script>";
}

$companies = $pdo->query("SELECT * FROM users WHERE role='company' ORDER BY created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($companies as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($c['email']); ?></td>
                    <td>
                        <span class="badge <?php echo ($c['status']=='approved')?'bg-success':(($c['status']=='pending')?'bg-warning':'bg-danger'); ?>">
                            <?php echo ucfirst($c['status']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if($c['status'] == 'pending'): ?>
                            <a href="?action=approve&id=<?php echo $c['id']; ?>" class="btn btn-sm btn-success">Approve</a>
                            <a href="?action=reject&id=<?php echo $c['id']; ?>" class="btn btn-sm btn-danger">Reject</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
