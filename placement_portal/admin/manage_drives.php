<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

$pageTitle = "Manage Drives";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">System Wide Placement Drives</h1>
</div>

<?php
// Handle Actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    if ($action == 'approve') {
        $pdo->prepare("UPDATE jobs SET status='approved' WHERE id=?")->execute([$id]);
    } elseif ($action == 'reject') {
        $pdo->prepare("UPDATE jobs SET status='rejected' WHERE id=?")->execute([$id]);
    } elseif ($action == 'delete') {
        $pdo->prepare("DELETE FROM jobs WHERE id=?")->execute([$id]);
    }
    echo "<script>window.location.href='manage_drives.php';</script>";
}

$jobs = $pdo->query("SELECT j.*, u.full_name as posted_by_name FROM jobs j JOIN users u ON j.posted_by = u.id ORDER BY j.created_at DESC")->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Company (Poster)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($jobs as $job): ?>
                <tr>
                    <td><?php echo $job['id']; ?></td>
                    <td><?php echo htmlspecialchars($job['title']); ?></td>
                    <td><?php echo htmlspecialchars($job['company_name']); ?> <small class="text-muted">(<?php echo $job['posted_by_name']; ?>)</small></td>
                    <td>
                        <?php if($job['status'] == 'approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php elseif($job['status'] == 'rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($job['status'] != 'approved'): ?>
                            <a href="?action=approve&id=<?php echo $job['id']; ?>" class="btn btn-sm btn-success" title="Approve"><i class="fas fa-check"></i></a>
                        <?php endif; ?>
                        <a href="?action=delete&id=<?php echo $job['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this job?')" title="Delete"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
