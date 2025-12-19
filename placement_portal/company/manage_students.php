<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Manage Applicants";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Student Applicants</h1>
</div>

<?php
$user_id = $_SESSION['user_id'];

// Handle Status Updates
if (isset($_GET['action']) && isset($_GET['app_id'])) {
    $action = $_GET['action']; // shortlist, select, reject
    $app_id = $_GET['app_id'];
    
    $new_status = '';
    if ($action == 'shortlist') $new_status = 'Shortlisted';
    if ($action == 'select') $new_status = 'Selected';
    if ($action == 'reject') $new_status = 'Rejected';
    
    if ($new_status) {
        $stmt = $pdo->prepare("UPDATE applications SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $app_id]);
        echo "<script>window.location.href='manage_students.php';</script>";
    }
}

// Fetch applicants for jobs posted by this company
$stmt = $pdo->prepare("
    SELECT a.id as app_id, a.status as app_status, a.applied_at,
           u.full_name, u.email,
           j.title as job_title
    FROM applications a
    JOIN jobs j ON a.job_id = j.id
    JOIN users u ON a.student_id = u.id
    WHERE j.posted_by = ?
    ORDER BY a.applied_at DESC
");
$stmt->execute([$user_id]);
$applicants = $stmt->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Job Role</th>
                    <th>Email</th>
                    <th>Applied Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($applicants as $app): ?>
                <tr>
                    <td><?php echo htmlspecialchars($app['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($app['job_title']); ?></td>
                    <td><?php echo htmlspecialchars($app['email']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></td>
                    <td>
                         <?php 
                        $statusClass = 'bg-secondary';
                        if($app['app_status'] == 'Selected') $statusClass = 'bg-success';
                        elseif($app['app_status'] == 'Rejected') $statusClass = 'bg-danger';
                        elseif($app['app_status'] == 'Shortlisted') $statusClass = 'bg-info';
                        elseif($app['app_status'] == 'Applied') $statusClass = 'bg-primary';
                        ?>
                        <span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($app['app_status']); ?></span>
                    </td>
                    <td>
                        <a href="?action=shortlist&app_id=<?php echo $app['app_id']; ?>" class="btn btn-sm btn-info text-white" title="Shortlist"><i class="fas fa-list"></i></a>
                        <a href="?action=select&app_id=<?php echo $app['app_id']; ?>" class="btn btn-sm btn-success" title="Select"><i class="fas fa-check"></i></a>
                        <a href="?action=reject&app_id=<?php echo $app['app_id']; ?>" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($applicants)): ?>
                    <tr><td colspan="6" class="text-center">No applications received yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
