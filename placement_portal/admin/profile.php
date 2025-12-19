<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

$pageTitle = "Admin Profile";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Admin Profile</h1>
</div>

<div class="card">
    <p>Administrator details.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
