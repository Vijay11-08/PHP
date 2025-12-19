<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Selection Results";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Declare Selection Results</h1>
</div>

<?php
$user_id = $_SESSION['user_id'];

// Fetch ONLY SELECTED applicants
$stmt = $pdo->prepare("
    SELECT u.full_name, u.email, j.title as job_title, a.status
    FROM applications a
    JOIN jobs j ON a.job_id = j.id
    JOIN users u ON a.student_id = u.id
    WHERE j.posted_by = ? AND a.status = 'Selected'
    ORDER BY j.title ASC
");
$stmt->execute([$user_id]);
$selected_students = $stmt->fetchAll();
?>

<div class="card">
    <h3>🎉 Selected Candidates</h3>
    <div class="table-responsive">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Job Profile</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($selected_students as $s): ?>
                <tr>
                    <td><?php echo htmlspecialchars($s['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($s['job_title']); ?></td>
                    <td><?php echo htmlspecialchars($s['email']); ?></td>
                    <td><span class="badge bg-success">Selected</span></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($selected_students)): ?>
                    <tr><td colspan="4" class="text-center">No candidates selected yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
