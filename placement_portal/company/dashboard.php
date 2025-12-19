<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter') checkAuth('company');
$user_id = $_SESSION['user_id'];
$company_name = $_SESSION['username']; 

// Handle Profile Update
if (isset($_POST['update_profile'])) {
    $website = $_POST['website'];
    $industry = $_POST['industry'];
    $location = $_POST['location'];
    
    // Check if exists
    $check = $pdo->prepare("SELECT user_id FROM company_details WHERE user_id=?");
    $check->execute([$user_id]);
    if($check->rowCount() > 0) {
        $stmt = $pdo->prepare("UPDATE company_details SET website=?, industry=?, location=? WHERE user_id=?");
        $stmt->execute([$website, $industry, $location, $user_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO company_details (user_id, website, industry, location) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $website, $industry, $location]);
    }
    $msg = "Profile updated!";
}

// Handle Job Post
if (isset($_POST['post_job'])) {
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $company_name, $user_id]);
    $msg = "Job posted successfully!";
}

// Fetch Data
$details = $pdo->prepare("SELECT * FROM company_details WHERE user_id=?");
$details->execute([$user_id]);
$profile = $details->fetch(PDO::FETCH_ASSOC) ?: ['website'=>'', 'industry'=>'', 'location'=>''];

$jobs = $pdo->prepare("SELECT j.*, (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id) as app_count FROM jobs j WHERE posted_by = ? ORDER BY created_at DESC");
$jobs->execute([$user_id]);
$my_jobs = $jobs->fetchAll();

// Stats
$total_apps = 0;
foreach($my_jobs as $j) $total_apps += $j['app_count'];

$pageTitle = "Company Dashboard";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Company Dashboard</h1></div>

<?php if(isset($msg)): ?>
    <div class="alert alert-success" style="padding:15px; background:#d1e7dd; color:#0f5132; margin-bottom:20px; border-radius:5px;">
        <?php echo $msg; ?>
    </div>
<?php endif; ?>

<!-- Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="border-left: 5px solid var(--primary); text-align: center;">
        <div style="font-size: 2rem; font-weight: bold; color: var(--primary);"><?php echo count($my_jobs); ?></div>
        <div style="color: #666;">Jobs Posted</div>
    </div>
    <div class="card" style="border-left: 5px solid var(--success); text-align: center;">
        <div style="font-size: 2rem; font-weight: bold; color: var(--success);"><?php echo $total_apps; ?></div>
        <div style="color: #666;">Total Applications</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- Profile Section -->
    <div class="card">
        <h3>Building Profile</h3>
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Website</label>
                <input type="url" name="website" class="form-control" value="<?php echo htmlspecialchars($profile['website']); ?>" placeholder="https://example.com">
            </div>
            <div class="form-group">
                <label class="form-label">Industry</label>
                <input type="text" name="industry" class="form-control" value="<?php echo htmlspecialchars($profile['industry']); ?>" placeholder="e.g. IT, Finance">
            </div>
            <div class="form-group">
                <label class="form-label">Location / HQ</label>
                <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($profile['location']); ?>" placeholder="e.g. Mumbai">
            </div>
            <button type="submit" name="update_profile" class="btn btn-secondary btn-sm">Update Profile</button>
        </form>
    </div>

    <!-- Post Job Section -->
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
</div>

<!-- Jobs List -->
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h3 style="margin:0;">My Posted Jobs</h3>
        <div>
            <button onclick="new TableExporter('jobTable', 'my_jobs').exportToExcel()" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i></button>
            <button onclick="new TableExporter('jobTable', 'my_jobs').exportToCSV()" class="btn btn-sm btn-info"><i class="fas fa-file-csv"></i></button>
            <button onclick="new TableExporter('jobTable', 'my_jobs').exportToPDF()" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></button>
        </div>
    </div>
    <input type="text" id="jobInput" onkeyup="filterTable('jobInput', 'jobTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <div class="table-responsive">
        <table class="table" id="jobTable">
            <thead><tr><th>Title</th><th>Date</th><th>Status</th><th>Applicants</th><th>Action</th></tr></thead>
            <tbody>
                <?php foreach($my_jobs as $j): ?>
                <tr>
                    <td><?php echo htmlspecialchars($j['title']); ?></td>
                    <td><?php echo date('d M Y', strtotime($j['created_at'])); ?></td>
                    <td>
                        <?php if($j['status'] == 'approved'): ?>
                            <span class="badge bg-success">Live</span>
                        <?php elseif($j['status'] == 'rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge bg-info"><?php echo $j['app_count']; ?></span></td>
                    <td><button class="btn btn-sm btn-secondary">View Candidates</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
