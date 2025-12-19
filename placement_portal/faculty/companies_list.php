<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('faculty');

$companies = $pdo->query("
    SELECT u.full_name, u.email, u.created_at,
    (SELECT COUNT(*) FROM jobs j WHERE j.posted_by = u.id) as job_count
    FROM users u 
    WHERE role='company' OR role='recruiter'
")->fetchAll();

$pageTitle = "Company Data";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Registered Companies</h1>
    <div>
        <button onclick="new TableExporter('compTable', 'companies_list').exportToExcel()" class="btn btn-sm btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="new TableExporter('compTable', 'companies_list').exportToCSV()" class="btn btn-sm btn-info"><i class="fas fa-file-csv"></i> CSV</button>
        <button onclick="new TableExporter('compTable', 'companies_list').exportToPDF()" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
    </div>
</div>

<div class="card">
    <input type="text" id="compInput" onkeyup="filterTable('compInput', 'compTable')" placeholder="Search Company..." class="form-control" style="margin-bottom:10px; width:200px;">
    <table class="table" id="compTable">
        <thead><tr><th>Company Name</th><th>Contact Email</th><th>Jobs Posted</th></tr></thead>
        <tbody>
            <?php foreach($companies as $c): ?>
            <tr>
                <td><?php echo htmlspecialchars($c['full_name']); ?></td>
                <td><?php echo htmlspecialchars($c['email']); ?></td>
                <td><?php echo $c['job_count']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../includes/footer.php'; ?>
