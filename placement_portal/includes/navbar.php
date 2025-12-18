<?php
// Determine active page for highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="public-navbar">
    <div class="container navbar-content">
        <a href="index.php" class="navbar-brand">
            <i class="fas fa-graduation-cap"></i> Placement Portal
        </a>
        <ul class="navbar-links">
            <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="login.php" class="<?php echo ($current_page == 'login.php') ? 'active' : ''; ?>"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <li><a href="register.php" class="<?php echo ($current_page == 'register.php') ? 'active' : ''; ?>"><i class="fas fa-user-plus"></i> Student Register</a></li>
        </ul>
    </div>
</nav>

<!-- Add a spacer so content isn't hidden behind fixed navbar if we make it fixed -->
<div style="height: 20px;"></div>
