<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');
$user_id = $_SESSION['user_id'];
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];
    $skills = $_POST['skills'];
    $stmt = $pdo->prepare("SELECT user_id FROM student_details WHERE user_id = ?");
    $stmt->execute([$user_id]);
    if ($stmt->rowCount() > 0) {
        $pdo->prepare("UPDATE student_details SET branch=?, cgpa=?, skills=? WHERE user_id=?")->execute([$branch, $cgpa, $skills, $user_id]);
    } else {
        $pdo->prepare("INSERT INTO student_details (user_id, branch, cgpa, skills) VALUES (?, ?, ?, ?)")->execute([$user_id, $branch, $cgpa, $skills]);
    }
    $msg = "Profile Updated!";
}

$p = $pdo->prepare("SELECT * FROM student_details WHERE user_id = ?");
$p->execute([$user_id]);
$p = $p->fetch();

$pageTitle = "My Profile";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">My Profile</h1></div>

<div class="card">
    <?php if($msg) echo "<div class='badge bg-success'>$msg</div><br><br>"; ?>
    <form method="POST">
        <div class="form-group">
            <label class="form-label">Branch</label>
            <input type="text" name="branch" class="form-control" value="<?php echo $p['branch'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">CGPA</label>
            <input type="number" step="0.01" name="cgpa" class="form-control" value="<?php echo $p['cgpa'] ?? ''; ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Skills</label>
            <textarea name="skills" class="form-control"><?php echo $p['skills'] ?? ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Profile</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
