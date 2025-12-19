<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('recruiter');
$user_id = $_SESSION['user_id'];
$company_name = $_SESSION['username']; 

// Handle Profile Update
if (isset($_POST['update_profile'])) {
    $phone = $_POST['phone'];
    $designation = $_POST['designation'];
    $linkedin = $_POST['linkedin'];
    
    // Check if exists
    $check = $pdo->prepare("SELECT user_id FROM recruiter_details WHERE user_id=?");
    $check->execute([$user_id]);
    if($check->rowCount() > 0) {
        $stmt = $pdo->prepare("UPDATE recruiter_details SET phone=?, designation=?, linkedin_url=? WHERE user_id=?");
        $stmt->execute([$phone, $designation, $linkedin, $user_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO recruiter_details (user_id, phone, designation, linkedin_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $phone, $designation, $linkedin]);
    }
    $msg = "Profile updated!";
}

// Handle Job Post
if (isset($_POST['post_job'])) {
    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $company_name, $user_id]);
    $msg = "Drive published!";
}

// Fetch Data
$details = $pdo->prepare("SELECT * FROM recruiter_details WHERE user_id=?");
$details->execute([$user_id]);
$profile = $details->fetch(PDO::FETCH_ASSOC) ?: ['phone'=>'', 'designation'=>'', 'linkedin_url'=>''];

$js = $pdo->prepare("SELECT j.*, (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id) as app_count FROM jobs j WHERE posted_by = ? ORDER BY created_at DESC");
$js->execute([$user_id]);
$my_jobs = $js->fetchAll();

// Stats
$active_drives = count($my_jobs);
$total_cands = 0;
foreach($my_jobs as $j) $total_cands += $j['app_count'];

$pageTitle = "Recruiter Dashboard";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Recruiter Portal</h1></div>

<?php if(isset($msg)): ?>
    <div class="alert alert-success" style="padding:15px; background:#d1e7dd; color:#0f5132; margin-bottom:20px; border-radius:5px;">
        <?php echo $msg; ?>
    </div>
<?php endif; ?>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="border-left: 5px solid var(--primary); text-align: center;">
        <div style="font-size: 2rem; font-weight: bold; color: var(--primary);"><?php echo $active_drives; ?></div>
        <div style="color: #666;">Active Drives</div>
    </div>
    <div class="card" style="border-left: 5px solid var(--warning); text-align: center;">
        <div style="font-size: 2rem; font-weight: bold; color: var(--warning);"><?php echo $total_cands; ?></div>
        <div style="color: #666;">Candidates</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <!-- Profile -->
    <div class="card">
        <h3>My Profile</h3>
        <form method="POST">
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($profile['phone']); ?>" placeholder="+91 9876543210">
            </div>
            <div class="form-group">
                <label class="form-label">Designation</label>
                <input type="text" name="designation" class="form-control" value="<?php echo htmlspecialchars($profile['designation']); ?>" placeholder="HR Manager">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin" class="form-control" value="<?php echo htmlspecialchars($profile['linkedin_url']); ?>" placeholder="linkedin.com/in/me">
            </div>
            <button type="submit" name="update_profile" class="btn btn-secondary btn-sm">Update Profile</button>
        </form>
    </div>

    <!-- Post Drive -->
    <div class="card">
        <h3>Post New Drive</h3>
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
</div>

<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h3 style="margin:0;">Active Drives</h3>
        <div>
            <button onclick="new TableExporter('driveTable', 'active_drives').exportToExcel()" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i></button>
            <button onclick="new TableExporter('driveTable', 'active_drives').exportToCSV()" class="btn btn-sm btn-info"><i class="fas fa-file-csv"></i></button>
            <button onclick="new TableExporter('driveTable', 'active_drives').exportToPDF()" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i></button>
        </div>
    </div>
    <input type="text" id="driveInput" onkeyup="filterTable('driveInput', 'driveTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <div class="table-responsive">
        <table class="table" id="driveTable">
            <thead><tr><th>Title</th><th>Date</th><th>Status</th><th>Applicants</th></tr></thead>
            <tbody>
                <?php foreach($my_jobs as $j): ?>
                <tr>
                    <td><?php echo htmlspecialchars($j['title']); ?></td>
                    <td><?php echo date('d M Y', strtotime($j['created_at'])); ?></td>
                    <td>
                        <?php if($j['status'] == 'approved'): ?>
                            <span class="badge bg-success">Active</span>
                        <?php elseif($j['status'] == 'rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $j['app_count']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
