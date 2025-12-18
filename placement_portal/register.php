<?php
require_once 'includes/auth.php';
require_once 'config/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($password !== $confirm_pass) {
        $error = "Passwords do not match!";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->rowCount() > 0) {
                $error = "Username or Email already exists!";
            } else {
                $hashed = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?, ?, ?, ?, 'student', 'pending')");
                $stmt->execute([$username, $email, $hashed, $full_name]);
                $success = "Registration successful! Your account is PENDING approval from Admin.";
            }
        } catch (PDOException $e) { $error = "Database Error: " . $e->getMessage(); }
    }
}

$pageTitle = "Student Registration";
$isPublicPage = true;
$pathAdjust = '';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2>🎓 Student Register</h2>
        
        <?php if($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if($success): ?>
            <div style="background: #d1e7dd; color: #0f5132; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?php echo $success; ?>
                <br><a href="login.php" style="font-weight:bold;">Go to Login</a>
            </div>
        <?php else: ?>
            <form method="POST">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <p style="margin-top: 15px; text-align: center;">
                    Already have an account? <a href="login.php">Login here</a>
                </p>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
