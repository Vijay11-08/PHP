<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('recruiter');
$user_id = $_SESSION['user_id'];
$company_name = $_SESSION['username']; 
if (isset($_POST['post_job'])) {
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $company_name, $user_id]);
}
$js = $pdo->prepare("SELECT j.*, (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id) as app_count FROM jobs j WHERE posted_by = ?");
$js->execute([$user_id]);
$my_jobs = $js->fetchAll();

$pageTitle = "Recruiter Portal";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Recruiter Portal</h1></div>

<div class="card">
    <h3>Post New Job Drive</h3>
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Job/Drive Title</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g. Campus Drive 2025">
        </div>
        <div class="form-group">
            <label class="form-label">Description / Criteria</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" name="post_job" class="btn btn-primary">Publish Drive</button>
    </form>
</div>

<div class="card">
    <h3>Active Drives</h3>
    <input type="text" id="driveInput" onkeyup="filterTable('driveInput', 'driveTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <div class="table-responsive">
        <table class="table" id="driveTable">
            <thead><tr><th>Title</th><th>Date</th><th>Applicants</th></tr></thead>
            <tbody>
                <?php foreach($my_jobs as $j): ?>
                <tr>
                    <td><?php echo htmlspecialchars($j['title']); ?></td>
                    <td><?php echo date('d M Y', strtotime($j['created_at'])); ?></td>
                    <td><?php echo $j['app_count']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
