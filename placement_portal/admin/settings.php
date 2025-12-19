<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

$pageTitle = "Admin Settings";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">System Settings</h1>
</div>

<div class="card">
    <p>Global system settings and configurations.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
