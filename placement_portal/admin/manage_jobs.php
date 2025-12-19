<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

// Handle Actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $status = ($action == 'approve') ? 'approved' : (($action == 'reject') ? 'rejected' : 'pending');
    
    if ($action == 'delete') {
        $pdo->prepare("DELETE FROM jobs WHERE id=?")->execute([$id]);
        $msg = "Job deleted successfully.";
    } else {
        $pdo->prepare("UPDATE jobs SET status=? WHERE id=?")->execute([$status, $id]);
        $msg = "Job status updated to $status.";
    }
    header("Location: manage_jobs.php?msg=$msg");
    exit();
}

$jobs = $pdo->query("SELECT j.*, u.full_name as poster_name, u.email as poster_email FROM jobs j LEFT JOIN users u ON j.posted_by = u.id ORDER BY j.created_at DESC")->fetchAll();

$pageTitle = "Manage Jobs";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Manage Jobs</h1>
    <div>
        <button onclick="new TableExporter('jobTable', 'jobs_list').exportToExcel()" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="new TableExporter('jobTable', 'jobs_list').exportToCSV()" class="btn btn-sm btn-info"><i class="fas fa-file-csv"></i> CSV</button>
        <button onclick="new TableExporter('jobTable', 'jobs_list').exportToPDF()" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
    </div>
</div>

<?php if(isset($_GET['msg'])): ?>
<div class="alert alert-info" style="padding:15px; margin-bottom:20px; background:#e2e3e5; border-radius:5px;">
    <?php echo htmlspecialchars($_GET['msg']); ?>
</div>
<?php endif; ?>

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
                    <th>Status</th>
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
                        <?php if($j['status'] == 'approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php elseif($j['status'] == 'rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($j['poster_name']); ?> <br>
                        <small class="text-muted"><?php echo htmlspecialchars($j['poster_email']); ?></small>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($j['created_at'])); ?></td>
                    <td>
                        <?php if($j['status'] == 'pending'): ?>
                            <a href="manage_jobs.php?action=approve&id=<?php echo $j['id']; ?>" class="btn btn-sm btn-success" title="Approve"><i class="fas fa-check"></i></a>
                            <a href="manage_jobs.php?action=reject&id=<?php echo $j['id']; ?>" class="btn btn-sm btn-warning" title="Reject"><i class="fas fa-times"></i></a>
                        <?php endif; ?>
                        <a href="manage_jobs.php?action=delete&id=<?php echo $j['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this job?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(count($jobs) == 0): ?>
                    <tr><td colspan="6">No jobs found.</td></tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
