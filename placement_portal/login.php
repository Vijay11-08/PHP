<?php
require_once 'includes/auth.php'; // Session start is here
require_once 'config/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            if ($user['status'] === 'pending') {
                $error = "Your account is still PENDING approval by Admin.";
            } elseif ($user['status'] === 'rejected') {
                $error = "Your account has been REJECTED. Contact Admin.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['full_name'] = $user['full_name'];

                switch ($user['role']) {
                    case 'admin': header("Location: admin/dashboard.php"); break;
                    case 'student': header("Location: student/dashboard.php"); break;
                    case 'faculty': header("Location: faculty/dashboard.php"); break;
                    case 'company': header("Location: company/dashboard.php"); break;
                    case 'recruiter': header("Location: recruiter/dashboard.php"); break;
                    default: header("Location: login.php");
                }
                exit();
            }
        } else {
            $error = "Invalid Username or Password";
        }
    } catch (PDOException $e) { $error = "Database Error"; }
}

$pageTitle = "Login - Placement Portal";
$isPublicPage = true;
$pathAdjust = '';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>🔒 Portal Login</h2>
        
        <?php if($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Enter username">
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p style="margin-top: 15px; text-align: center;">
                Student? <a href="register.php">Register here</a>
            </p>
        </form>
        
        <div style="margin-top:20px; font-size: 0.8rem; color: #888; text-align: center; border-top: 1px solid #eee; padding-top: 10px;">
            Demo: admin / password
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
