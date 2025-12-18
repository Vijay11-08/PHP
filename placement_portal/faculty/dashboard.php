<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$jobs = $pdo->query("SELECT j.title, j.company_name, (SELECT COUNT(*) FROM applications a WHERE a.job_id = j.id) as app_count FROM jobs j")->fetchAll();
$students = $pdo->query("SELECT * FROM users WHERE role='student' AND status='approved'")->fetchAll();

$pageTitle = "Faculty Overview";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header"><h1 class="page-title">Faculty Overview</h1></div>

<div class="card">
    <h3>Placement Drive Status</h3>
    <input type="text" id="statusInput" onkeyup="filterTable('statusInput', 'statusTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <table class="table" id="statusTable">
        <thead><tr><th>Company</th><th>Job Profile</th><th>Students Applied</th></tr></thead>
        <tbody>
            <?php foreach($jobs as $j): ?>
            <tr>
                <td><?php echo htmlspecialchars($j['company_name']); ?></td>
                <td><?php echo htmlspecialchars($j['title']); ?></td>
                <td><?php echo $j['app_count']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="card">
    <h3>Approved Students List</h3>
    <input type="text" id="studentInput" onkeyup="filterTable('studentInput', 'studentTable')" placeholder="Search Student..." class="form-control" style="margin-bottom:10px; width:200px;">
    <table class="table" id="studentTable">
        <thead><tr><th>Name</th><th>Email</th><th>Reg. Date</th></tr></thead>
        <tbody>
            <?php foreach($students as $s): ?>
            <tr>
                <td><?php echo htmlspecialchars($s['full_name']); ?></td>
                <td><?php echo htmlspecialchars($s['email']); ?></td>
                <td><?php echo date('d M Y', strtotime($s['created_at'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
