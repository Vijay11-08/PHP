<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$pageTitle = "Faculty Profile";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">My Profile</h1>
</div>

<div class="card">
    <p>View and edit profile details.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
