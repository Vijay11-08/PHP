<?php
require_once 'auth.php';
requireLogin(); // Protect this page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container dashboard-container">
        <div class="header">
            <h2>Dashboard</h2>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
        
        <div class="alert alert-success">
            Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>!
        </div>

        <p>You have successfully logged in.</p>
        <p>This is a protected area. Only authenticated users can see this page.</p>
        
        <br>
        <h3>Your Session Details:</h3>
        <pre><?php print_r($_SESSION); ?></pre>
    </div>
</body>
</html>
