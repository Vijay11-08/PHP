<?php
require_once 'config/db.php';

try {
    echo "<h1>Updating Demo Data...</h1>";

    // 1. Get all students and jobs
    $students = $pdo->query("SELECT id FROM users WHERE role='student'")->fetchAll(PDO::FETCH_COLUMN);
    $jobs = $pdo->query("SELECT id FROM jobs")->fetchAll(PDO::FETCH_COLUMN);

    if (empty($students) || empty($jobs)) {
        die("Please run setup_data.php first to create users and jobs.");
    }

    echo "Found " . count($students) . " students and " . count($jobs) . " jobs.<br>";

    // 2. Clear existing applications (optional, but good for reset)
    $pdo->exec("DELETE FROM applications");
    echo "Cleared old applications.<br>";

    // 3. Randomly assign applications
    $statuses = ['Applied', 'Selected', 'Rejected', 'Pending', 'Interviewing'];
    $count = 0;

    $stmt = $pdo->prepare("INSERT INTO applications (job_id, student_id, status) VALUES (?, ?, ?)");

    foreach ($students as $index => $student_id) {
        // Each student applies to 1-3 random jobs
        $num_applications = rand(1, 3);
        $random_jobs = array_rand(array_flip($jobs), $num_applications);
        if (!is_array($random_jobs)) $random_jobs = [$random_jobs];

        foreach ($random_jobs as $job_index => $job_id) {
            // Force distribution: Cycle through statuses
            // 0=Selected, 1=Rejected, 2=Pending, 3=Applied
            $mode = ($count) % 4;
            if ($mode == 0) $status = 'Selected';
            elseif ($mode == 1) $status = 'Rejected';
            elseif ($mode == 2) $status = 'Pending';
            else $status = 'Applied';
            
            $stmt->execute([$job_id, $student_id, $status]);
            $count++;
        }
    }

    echo "Created $count new applications with varied statuses.<br>";

    // 4. Ensure mixed user statuses
    // Set 10% to Pending, 5% to Rejected, rest Approved
    $pdo->exec("UPDATE users SET status = 'approved' WHERE role != 'admin'"); // Reset
    
    // Pending
    $pdo->exec("UPDATE users SET status = 'pending' WHERE role != 'admin' AND id % 10 = 0");
    // Rejected
    $pdo->exec("UPDATE users SET status = 'rejected' WHERE role != 'admin' AND id % 20 = 0");

    echo "Updated user statuses: Added some Pending and Rejected users.<br>";

    echo "<h2 style='color:green'>Update Complete!</h2>";
    echo "<a href='admin/manage_users.php'>Go to Admin Users</a> | <a href='student/dashboard.php'>Go to Student Dashboard</a>";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
