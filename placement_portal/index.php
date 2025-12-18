<?php
$pageTitle = "Home - Placement Portal";
$isPublicPage = true;
$pathAdjust = '';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

?>

<div class="hero">
    <div class="container">
        <h1>Campus Placement Portal</h1>
        <p>Connecting Students, Faculty, and Top Recruiters in one unified platform. Start your career journey today.</p>
        <div class="hero-buttons">
            <a href="login.php" class="btn btn-light">Login Now</a>
            <a href="register.php" class="btn btn-outline-white">Student Registration</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h3>For Students</h3>
            <p>Create your profile, showcase your skills, upload resumes, and apply to top-tier company placement drives instantly.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="color: var(--success); background-color: rgba(25, 135, 84, 0.1);">
                <i class="fas fa-building"></i>
            </div>
            <h3>For Companies</h3>
            <p>Post job openings, track applicants, shortlist candidates, and manage your recruitment process efficiently.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon" style="color: var(--warning); background-color: rgba(255, 193, 7, 0.1);">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <h3>For Faculty</h3>
            <p>Track student placement progress, monitor live statistics, and ensure successful career launches for your batch.</p>
        </div>
    </div>
</div>

<?php 
// Fetch Live Public Stats if possible, else use static placeholder driven by DB logic in a real app
// Since this is index.php, we need to include db config to fetch real data
require_once 'config/db.php';
try {
    $total_students = $pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
    $placed_students = $pdo->query("SELECT COUNT(DISTINCT student_id) FROM applications WHERE status='Selected'")->fetchColumn();
    $companies_onboard = $pdo->query("SELECT COUNT(*) FROM users WHERE role='company'")->fetchColumn();
} catch (Exception $e) {
    // Fallback if DB not set up
    $total_students = 0; $placed_students = 0; $companies_onboard = 0; 
}
?>

<div class="container" style="margin-bottom: 60px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-weight: 800; color: var(--dark); font-size: 2.5rem;">Our Impact</h2>
        <p style="color: #666; font-size: 1.1rem;">Real-time statistics from our placement drives.</p>
    </div>
    
    <div class="features-grid">
        <div class="card" style="text-align:center; padding: 40px 20px; border-top: 5px solid var(--primary);">
            <i class="fas fa-users" style="font-size: 3rem; color: var(--primary); margin-bottom:20px;"></i>
            <h3 style="font-size: 3rem; margin: 10px 0; color: var(--dark);"><?php echo $total_students; ?>+</h3>
            <p style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold; color: #999;">Registered Students</p>
        </div>
        <div class="card" style="text-align:center; padding: 40px 20px; border-top: 5px solid var(--success);">
            <i class="fas fa-briefcase" style="font-size: 3rem; color: var(--success); margin-bottom:20px;"></i>
            <h3 style="font-size: 3rem; margin: 10px 0; color: var(--dark);"><?php echo $placed_students; ?>+</h3>
            <p style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold; color: #999;">Students Placed</p>
        </div>
        <div class="card" style="text-align:center; padding: 40px 20px; border-top: 5px solid var(--warning);">
            <i class="fas fa-building" style="font-size: 3rem; color: var(--warning); margin-bottom:20px;"></i>
            <h3 style="font-size: 3rem; margin: 10px 0; color: var(--dark);"><?php echo $companies_onboard; ?>+</h3>
            <p style="text-transform: uppercase; letter-spacing: 1px; font-weight: bold; color: #999;">Hiring Companies</p>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>


