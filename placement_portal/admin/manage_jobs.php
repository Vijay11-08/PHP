<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

// Delete Job Logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM jobs WHERE id=?")->execute([$id]);
    header("Location: manage_jobs.php?msg=Deleted");
    exit();
}

$jobs = $pdo->query("SELECT j.*, u.full_name as poster_name, u.email as poster_email FROM jobs j LEFT JOIN users u ON j.posted_by = u.id ORDER BY j.created_at DESC")->fetchAll();

$pageTitle = "Manage Jobs";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Manage Jobs</h1>
</div>

<div class="card">
    <div style="margin-bottom: 20px;">
        <input type="text" id="jobInput" onkeyup="filterTable('jobInput', 'jobTable')" placeholder="Search jobs, companies..." class="form-control" style="max-width: 300px;">
    </div>

    <div class="table-responsive">
        <table class="table" id="jobTable">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Posted By</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($jobs as $j): ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($j['title']); ?></strong></td>
                    <td><?php echo htmlspecialchars($j['company_name']); ?></td>
                    <td>
                        <?php echo htmlspecialchars($j['poster_name']); ?> <br>
                        <small class="text-muted"><?php echo htmlspecialchars($j['poster_email']); ?></small>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($j['created_at'])); ?></td>
                    <td>
                        <a href="manage_jobs.php?delete=<?php echo $j['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this job?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(count($jobs) == 0): ?>
                    <tr><td colspan="5">No jobs found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
