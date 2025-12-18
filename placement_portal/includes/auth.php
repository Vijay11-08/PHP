<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
function checkAuth($role = null) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
    
    if ($role && $_SESSION['role'] !== $role) {
        die("<div style='text-align:center; padding:50px; font-family:sans-serif;'>
            <h1>Access Denied</h1>
            <p>You do not have permission to view this page.</p>
            <a href='../logout.php'>Logout</a>
            </div>");
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>
