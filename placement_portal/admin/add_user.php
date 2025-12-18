<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?,?,?,?,?,'approved')");
        $stmt->execute([$username, $email, $password, $full_name, $role]);
        $msg = "User added successfully!";
    } catch (PDOException $e) { $msg = "Error: " . $e->getMessage(); }
}

$pageTitle = "Add User";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Add New User</h1></div>

<div class="card" style="max-width: 600px;">
    <?php if($msg) echo "<div class='badge bg-success' style='display:block;margin-bottom:10px;'>$msg</div>"; ?>
    
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
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="faculty">Faculty</option>
                <option value="company">Company</option>
                <option value="recruiter">Recruiter</option>
                <option value="student">Student</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
