<?php
$role = $_SESSION['role'] ?? 'student';
$path_adjust = isset($pathAdjust) ? $pathAdjust : '../'; 
?>
<div class="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-graduation-cap"></i> Portal
    </div>
    
    <ul class="nav-links">
        <?php if($role === 'admin'): ?>
            <li class="nav-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="manage_users.php"><i class="fas fa-users"></i> Users</a></li>
            <li class="nav-item"><a href="manage_drives.php"><i class="fas fa-hdd"></i> Drive</a></li>
            <li class="nav-item"><a href="manage_companies.php"><i class="fas fa-building"></i> Company</a></li>
            <li class="nav-item"><a href="results.php"><i class="fas fa-trophy"></i> Result</a></li>
            <li class="nav-item"><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li class="nav-item"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            
        <?php elseif($role === 'student'): ?>
            <li class="nav-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="drive.php"><i class="fas fa-hdd"></i> Drive</a></li>
            <li class="nav-item"><a href="company.php"><i class="fas fa-building"></i> Company</a></li>
            <li class="nav-item"><a href="results.php"><i class="fas fa-trophy"></i> Result</a></li>
            <li class="nav-item"><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li class="nav-item"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            
        <?php elseif($role === 'faculty'): ?>
            <li class="nav-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="manage_drives.php"><i class="fas fa-hdd"></i> Manage Drive</a></li>
            <li class="nav-item"><a href="manage_companies.php"><i class="fas fa-building"></i> Manage Company</a></li>
            <li class="nav-item"><a href="results.php"><i class="fas fa-trophy"></i> Result</a></li>
            <li class="nav-item"><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li class="nav-item"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li class="nav-item"><a href="company_register_student.php"><i class="fas fa-user-plus"></i> Company Register Student</a></li>
            
        <?php elseif($role === 'company' || $role === 'recruiter'): ?>
            <li class="nav-item"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item"><a href="drive.php"><i class="fas fa-hdd"></i> Drive</a></li>
            <li class="nav-item"><a href="manage_students.php"><i class="fas fa-user-graduate"></i> Manage Students</a></li>
            <li class="nav-item"><a href="create_drive.php"><i class="fas fa-plus-circle"></i> Create a Drive</a></li>
            <li class="nav-item"><a href="results.php"><i class="fas fa-trophy"></i> Result</a></li>
            <li class="nav-item"><a href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li>
            <li class="nav-item"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
        <?php endif; ?>
    </ul>

    <div class="nav-profile">
        <div style="margin-bottom: 5px;">
            <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
        </div>
        <a href="<?php echo $path_adjust; ?>logout.php" class="btn btn-sm btn-danger" style="width: 100%; display:block; padding: 5px 0;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<!-- Main Content Wrapper Start -->
<div class="main-content">
