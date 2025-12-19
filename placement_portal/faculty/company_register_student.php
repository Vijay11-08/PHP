<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$pageTitle = "Register Student via Company";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Register Student for Company</h1>
</div>

<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $job_id = $_POST['job_id'];

    // Find student ID
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND role = 'student'");
    $stmt->execute([$email]);
    $student = $stmt->fetch();

    if ($student) {
        $student_id = $student['id'];
        
        // Check if already applied
        $check = $pdo->prepare("SELECT id FROM applications WHERE job_id=? AND student_id=?");
        $check->execute([$job_id, $student_id]);
        
        if ($check->rowCount() == 0) {
            $insert = $pdo->prepare("INSERT INTO applications (job_id, student_id, status) VALUES (?, ?, 'Applied')");
            if ($insert->execute([$job_id, $student_id])) {
                $msg = "<div class='alert alert-success'>Student registered successfully!</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Database error.</div>";
            }
        } else {
            $msg = "<div class='alert alert-warning'>Student already applied to this drive.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Student email not found.</div>";
    }
}

// Fetch Active Jobs
$jobs = $pdo->query("SELECT id, title, company_name FROM jobs WHERE status='approved' ORDER BY created_at DESC")->fetchAll();
?>

<?php echo $msg; ?>

<div class="card">
    <p>Form to manually register a student for a specific company drive.</p>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Student Email</label>
            <input type="email" name="email" class="form-control" required placeholder="student@example.com">
        </div>
        <div class="mb-3">
            <label class="form-label">Select Company/Drive</label>
            <select name="job_id" class="form-control" required>
                <option value="">Select Drive...</option>
                <?php foreach($jobs as $j): ?>
                    <option value="<?php echo $j['id']; ?>"><?php echo htmlspecialchars($j['title'] . " - " . $j['company_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register Student</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
