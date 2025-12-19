<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
// Allow both company and recruiter roles
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "My Job Drives";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">My Job Drives</h1>
    <a href="create_drive.php" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Drive</a>
</div>

<?php
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE posted_by = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$my_jobs = $stmt->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Posted Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($my_jobs as $job): ?>
                <tr>
                    <td><?php echo htmlspecialchars($job['title']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($job['created_at'])); ?></td>
                    <td>
                        <?php if($job['status'] == 'approved'): ?>
                            <span class="badge bg-success">Active</span>
                        <?php elseif($job['status'] == 'rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending Approval</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="manage_students.php?job_id=<?php echo $job['id']; ?>" class="btn btn-sm btn-info text-white">View Applicants</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($my_jobs)): ?>
                    <tr><td colspan="4" class="text-center">You haven't posted any drives yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
