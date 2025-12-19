<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'company' && $_SESSION['role'] !== 'recruiter')) {
    header("Location: ../login.php");
    exit;
}

$pageTitle = "Account Settings";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Settings</h1>
</div>

<div class="card">
    <p>Change password and account preferences.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
