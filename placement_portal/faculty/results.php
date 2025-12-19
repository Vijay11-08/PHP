<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$apps = $pdo->query("
    SELECT u.full_name as student_name, j.title, j.company_name, a.status, a.applied_at
    FROM applications a
    JOIN users u ON a.student_id = u.id
    JOIN jobs j ON a.job_id = j.id
    ORDER BY a.applied_at DESC
")->fetchAll();

$pageTitle = "Placement Results";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Placement Results</h1>
    <div>
        <button onclick="new TableExporter('resTable', 'faculty_results').exportToExcel()" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="new TableExporter('resTable', 'faculty_results').exportToCSV()" class="btn btn-sm btn-info"><i class="fas fa-file-csv"></i> CSV</button>
        <button onclick="new TableExporter('resTable', 'faculty_results').exportToPDF()" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
    </div>
</div>

<div class="card">
    <input type="text" id="resInput" onkeyup="filterTable('resInput', 'resTable')" placeholder="Search..." class="form-control" style="margin-bottom:10px; width:200px;">
    <table class="table" id="resTable">
        <thead><tr><th>Student</th><th>Company</th><th>Job/Role</th><th>Status</th></tr></thead>
        <tbody>
            <?php foreach($apps as $a): ?>
            <tr>
                <td><?php echo htmlspecialchars($a['student_name']); ?></td>
                <td><?php echo htmlspecialchars($a['company_name']); ?></td>
                <td><?php echo htmlspecialchars($a['title']); ?></td>
                <td>
                    <?php if($a['status']=='Selected'): ?>
                        <span class="badge bg-success">Selected</span>
                    <?php elseif($a['status']=='Rejected'): ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php else: ?>
                        <span class="badge bg-warning"><?php echo $a['status']; ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
