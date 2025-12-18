<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_pass = $_POST['new_password'];
    $hashed = password_hash($new_pass, PASSWORD_BCRYPT);
    $pdo->prepare("UPDATE users SET password=? WHERE id=?")->execute([$hashed, $_SESSION['user_id']]);
    $msg = "Password Changed Successfully!";
}

$pageTitle = "Settings";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Settings</h1></div>

<div class="card">
    <?php if($msg) echo "<div class='badge bg-success'>$msg</div><br><br>"; ?>
    <form method="POST">
        <div class="form-group">
            <label class="form-label">New Password</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
