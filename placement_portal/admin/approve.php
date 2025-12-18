<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    $status = ($action === 'approve') ? 'approved' : 'rejected';

    try {
        // Update Status
        $stmt = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);

        // Fetch User Email
        $stmt_u = $pdo->prepare("SELECT email, full_name FROM users WHERE id = ?");
        $stmt_u->execute([$id]);
        $user = $stmt_u->fetch();

        // Send Email (Simulation)
        if ($user) {
            $to = $user['email'];
            $subject = "Placement Portal Account Status";
            $message = "Hello {$user['full_name']},\n\nYour account has been $status by the Admin.\n\nLogin here: http://localhost/php_basic/placement_portal/login.php";
            
            // mail($to, $subject, $message); // Uncomment if SMTP configured
        }

        header("Location: dashboard.php?msg=User $status");

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    header("Location: dashboard.php");
}
?>
