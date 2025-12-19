<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Create Job Drive";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Post a New Job Drive</h1>
</div>

<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company_name = $_SESSION['username']; // Or fetch from profile if available
    $posted_by = $_SESSION['user_id'];
    
    // Simple validation
    if (!empty($title) && !empty($description)) {
        $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by, status) VALUES (?, ?, ?, ?, 'pending')");
        if ($stmt->execute([$title, $description, $company_name, $posted_by])) {
            $msg = "<div class='alert alert-success'>Job Drive Created Successfully! Pending Admin Approval.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Error creating drive.</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>Please fill all fields.</div>";
    }
}
?>

<?php echo $msg; ?>

<div class="card">
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Job Title / Role</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g. Software Engineer">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Job Description & Requirements</label>
            <textarea name="description" class="form-control" rows="6" required placeholder="Enter job details, eligibility criteria, and required skills..."></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit for Approval</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
