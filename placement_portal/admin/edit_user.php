<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

$error = '';
$success = '';
$user = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User not found.");
    }
} else {
    header("Location: manage_users.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $status = $_POST['status'];
    
    // Optional password update
    $password_sql = "";
    $params = [$full_name, $email, $role, $status];

    if (!empty($_POST['password'])) {
        $password_sql = ", password = ?";
        $params[] = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }
    
    $params[] = $id; // For WHERE clause

    try {
        $sql = "UPDATE users SET full_name = ?, email = ?, role = ?, status = ? $password_sql WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $success = "User updated successfully!";
        
        // Refresh user data
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();

    } catch (PDOException $e) {
        $error = "Update failed: " . $e->getMessage();
    }
}

$pageTitle = "Edit User";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Edit User: <?php echo htmlspecialchars($user['username']); ?></h1>
    <a href="manage_users.php" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="card" style="max-width: 600px;">
    <?php if($error): ?>
        <div class="badge bg-danger" style="display:block; margin-bottom:15px; padding:10px;"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="badge bg-success" style="display:block; margin-bottom:15px; padding:10px;"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-control">
                <option value="student" <?php echo ($user['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
                <option value="faculty" <?php echo ($user['role'] == 'faculty') ? 'selected' : ''; ?>>Faculty</option>
                <option value="company" <?php echo ($user['role'] == 'company') ? 'selected' : ''; ?>>Company</option>
                <option value="recruiter" <?php echo ($user['role'] == 'recruiter') ? 'selected' : ''; ?>>Recruiter</option>
                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="approved" <?php echo ($user['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                <option value="pending" <?php echo ($user['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="rejected" <?php echo ($user['status'] == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control" placeholder="Optional">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
