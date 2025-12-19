<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Company Profile";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Company Profile</h1>
</div>

<div class="card">
    <p>View and edit company details.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
