<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');

$pageTitle = "My Results";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Placement Results</h1>
</div>

<?php
$user_id = $_SESSION['user_id'];

// Fetch applications with job details
$stmt = $pdo->prepare("
    SELECT a.*, j.title as job_title, j.company_name 
    FROM applications a 
    JOIN jobs j ON a.job_id = j.id 
    WHERE a.student_id = ?
    ORDER BY a.applied_at DESC
");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Company</th>
                    <th>Applied On</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($applications as $app): ?>
                <tr>
                    <td><?php echo htmlspecialchars($app['job_title']); ?></td>
                    <td><?php echo htmlspecialchars($app['company_name']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($app['applied_at'])); ?></td>
                    <td>
                        <?php 
                        $statusClass = 'bg-secondary';
                        if($app['status'] == 'Selected') $statusClass = 'bg-success';
                        elseif($app['status'] == 'Rejected') $statusClass = 'bg-danger';
                        elseif($app['status'] == 'Shortlisted') $statusClass = 'bg-info';
                        elseif($app['status'] == 'Applied') $statusClass = 'bg-primary';
                        ?>
                        <span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($app['status']); ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($applications)): ?>
                    <tr><td colspan="4" class="text-center">You haven't applied to any jobs yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
