<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter') checkAuth('company');
$user_id = $_SESSION['user_id'];
$company_name = $_SESSION['username']; 
if (isset($_POST['post_job'])) {
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $company_name, $user_id]);
}
$jobs = $pdo->prepare("SELECT j.*, (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id) as app_count FROM jobs j WHERE posted_by = ?");
$jobs->execute([$user_id]);
$my_jobs = $jobs->fetchAll();

$pageTitle = "Company Dashboard";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Manage Jobs</h1></div>

<div class="card">
    <h3>Post New Job</h3>
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Job Title</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g. Software Engineer">
        </div>
        <div class="form-group">
            <label class="form-label">Job Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" name="post_job" class="btn btn-primary">Post Job</button>
    </form>
</div>

<div class="card">
    <h3>My Posted Jobs</h3>
    <input type="text" id="jobInput" onkeyup="filterTable('jobInput', 'jobTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <div class="table-responsive">
        <table class="table" id="jobTable">
            <thead><tr><th>Title</th><th>Date</th><th>Applicants</th><th>Action</th></tr></thead>
            <tbody>
                <?php foreach($my_jobs as $j): ?>
                <tr>
                    <td><?php echo htmlspecialchars($j['title']); ?></td>
                    <td><?php echo date('d M Y', strtotime($j['created_at'])); ?></td>
                    <td><span class="badge bg-info"><?php echo $j['app_count']; ?></span></td>
                    <td><button class="btn btn-sm btn-secondary">View Candidates</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
