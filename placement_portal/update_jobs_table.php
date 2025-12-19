<?php
require_once 'config/db.php';

try {
    // Check if column exists, if not add it
    $stmt = $pdo->query("SHOW COLUMNS FROM jobs LIKE 'status'");
    if ($stmt->rowCount() == 0) {
        $pdo->exec("ALTER TABLE jobs ADD COLUMN status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'");
        $pdo->exec("UPDATE jobs SET status = 'approved'"); // Approve existing jobs
        echo "<h1>Job Status Column Added & Existing Jobs Approved!</h1>";
    } else {
        echo "<h1>Status Column Already Exists.</h1>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
