<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    $student_id = $_SESSION['user_id'];

    try {
        // Check if already applied
        $check = $pdo->prepare("SELECT id FROM applications WHERE job_id=? AND student_id=?");
        $check->execute([$job_id, $student_id]);
        
        if ($check->rowCount() == 0) {
            $stmt = $pdo->prepare("INSERT INTO applications (job_id, student_id) VALUES (?, ?)");
            $stmt->execute([$job_id, $student_id]);
        }
        
    } catch (Exception $e) {
        // Ignore error or log
    }
}
header("Location: dashboard.php");
?>
