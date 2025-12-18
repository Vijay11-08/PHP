<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

// Fetch Stats
$stats = [];
$stats['students'] = $pdo->query("SELECT COUNT(*) FROM users WHERE role='student'")->fetchColumn();
$stats['pending'] = $pdo->query("SELECT COUNT(*) FROM users WHERE status='pending'")->fetchColumn();
$stats['jobs'] = $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
$stats['companies'] = $pdo->query("SELECT COUNT(*) FROM users WHERE role='company'")->fetchColumn();
$pending_users = $pdo->query("SELECT * FROM users WHERE status='pending' LIMIT 5")->fetchAll();

$pageTitle = "Admin Dashboard";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Dashboard Overview</h1>
</div>

<!-- Stats Grid -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <!-- Students -->
    <a href="manage_users.php?role=student" style="text-decoration:none;">
        <div class="card" style="border-left: 5px solid var(--primary); text-align: center; transition:transform 0.2s;">
            <div style="font-size: 2rem; font-weight: bold; color: var(--primary);"><?php echo $stats['students']; ?></div>
            <div style="color: #666;">Total Students</div>
        </div>
    </a>
    
    <!-- Faculty (New) -->
     <?php $stats['faculty'] = $pdo->query("SELECT COUNT(*) FROM users WHERE role='faculty'")->fetchColumn(); ?>
    <a href="manage_users.php?role=faculty" style="text-decoration:none;">
        <div class="card" style="border-left: 5px solid #17a2b8; text-align: center; transition:transform 0.2s;">
            <div style="font-size: 2rem; font-weight: bold; color: #17a2b8;"><?php echo $stats['faculty']; ?></div>
            <div style="color: #666;">Faculty Members</div>
        </div>
    </a>

    <!-- Pending -->
    <a href="manage_users.php?status=pending" style="text-decoration:none;">
        <div class="card" style="border-left: 5px solid var(--warning); text-align: center; transition:transform 0.2s;">
            <div style="font-size: 2rem; font-weight: bold; color: var(--warning);"><?php echo $stats['pending']; ?></div>
            <div style="color: #666;">Pending Requests</div>
        </div>
    </a>

    <!-- Jobs -->
    <a href="manage_jobs.php" style="text-decoration:none;">
        <div class="card" style="border-left: 5px solid var(--success); text-align: center; transition:transform 0.2s;">
            <div style="font-size: 2rem; font-weight: bold; color: var(--success);"><?php echo $stats['jobs']; ?></div>
            <div style="color: #666;">Active Jobs</div>
        </div>
    </a>

    <!-- Companies -->
    <a href="manage_users.php?role=company" style="text-decoration:none;">
        <div class="card" style="border-left: 5px solid #6610f2; text-align: center; transition:transform 0.2s;">
            <div style="font-size: 2rem; font-weight: bold; color: #6610f2;"><?php echo $stats['companies']; ?></div>
            <div style="color: #666;">Companies</div>
        </div>
    </a>
</div>

<!-- Application Status Chart -->
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h3>📊 Application Status Breakdown</h3>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- CDN for Chart.js -->
    </div>
    <div style="position: relative; height:40vh; width:100%; display:flex; justify-content:center;">
        <canvas id="appStatusChart"></canvas>
    </div>
    
    <?php
    // Fetch Application Status Data for Chart
    $chartData = $pdo->query("SELECT status, COUNT(*) as count FROM applications GROUP BY status")->fetchAll(PDO::FETCH_KEY_PAIR);
    
    // Default 0 for missing statuses
    $labels = ['Applied', 'Selected', 'Rejected', 'Pending'];
    $data = [];
    foreach($labels as $l) {
        $data[] = isset($chartData[$l]) ? $chartData[$l] : 0; 
    }
    
    // JS Data
    $jsLabels = json_encode($labels);
    $jsData = json_encode($data);
    ?>

    <script>
    const ctx = document.getElementById('appStatusChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo $jsLabels; ?>,
            datasets: [{
                label: 'Applications',
                data: <?php echo $jsData; ?>,
                backgroundColor: [
                    '#0d6efd', // Applied (Primary)
                    '#198754', // Selected (Success)
                    '#dc3545', // Rejected (Danger)
                    '#ffc107'  // Pending (Warning)
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    </script>
</div>


<!-- Pending Approvals -->
<div class="card">
    <h3>🔔 Pending Student Approvals</h3>
    <div class="table-responsive">
        <table class="table" id="pendingTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($pending_users) > 0): ?>
                    <?php foreach($pending_users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><span class="badge bg-secondary"><?php echo ucfirst($u['role']); ?></span></td>
                        <td>
                            <a href="approve.php?id=<?php echo $u['id']; ?>&action=approve" class="btn btn-sm btn-success">Approve</a>
                            <a href="approve.php?id=<?php echo $u['id']; ?>&action=reject" class="btn btn-sm btn-danger" onclick="return confirm('Reject this user?')">Reject</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center; color:#999;">No pending approvals.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($stats['pending'] > 5): ?>
        <div style="margin-top:10px; text-align:right;"><a href="manage_users.php?filter=pending">View All Pending</a></div>
    <?php endif; ?>
</div>

<?php require_once '../includes/footer.php'; ?>
