<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$pageTitle = "Settings";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Account Settings</h1>
</div>

<div class="card">
    <p>Change password and system preferences.</p>
</div>

<?php require_once '../includes/footer.php'; ?>
