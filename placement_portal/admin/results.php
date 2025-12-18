<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

if (isset($_POST['update_status'])) {
    $app_id = $_POST['app_id'];
    $status = $_POST['status'];
    $pdo->prepare("UPDATE applications SET status=? WHERE id=?")->execute([$status, $app_id]);
}

$apps = $pdo->query("
    SELECT a.id, a.status, a.applied_at, 
           u.full_name as student_name, u.email,
           j.title as job_title, j.company_name
    FROM applications a
    JOIN users u ON a.student_id = u.id
    JOIN jobs j ON a.job_id = j.id
    ORDER BY a.applied_at DESC
")->fetchAll();

$pageTitle = "Placement Results";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>


<?php
// Statistics
$stats = [
    'selected' => 0,
    'pending' => 0,
    'rejected' => 0,
    'total' => count($apps)
];

foreach ($apps as $a) {
    if ($a['status'] == 'Selected') $stats['selected']++;
    elseif ($a['status'] == 'Rejected') $stats['rejected']++;
    else $stats['pending']++;
}
?>

<div class="page-header"><h1 class="page-title">Placement Drive Results</h1></div>

<!-- Stats Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="card" style="border-left: 5px solid var(--success); margin:0;">
        <h3 style="margin-bottom:10px; font-size:1.2rem;">Selected Students</h3>
        <p style="font-size:2rem; font-weight:bold; margin:0; color:var(--success);"><?php echo $stats['selected']; ?></p>
    </div>
    <div class="card" style="border-left: 5px solid var(--warning); margin:0;">
        <h3 style="margin-bottom:10px; font-size:1.2rem;">Pending/In-Process</h3>
        <p style="font-size:2rem; font-weight:bold; margin:0; color:var(--warning);"><?php echo $stats['pending']; ?></p>
    </div>
    <div class="card" style="border-left: 5px solid var(--primary); margin:0;">
        <h3 style="margin-bottom:10px; font-size:1.2rem;">Total Applications</h3>
        <p style="font-size:2rem; font-weight:bold; margin:0; color:var(--primary);"><?php echo $stats['total']; ?></p>
    </div>
</div>

<!-- Tabs -->
<div style="margin-bottom: 20px;">
    <button class="btn btn-primary tab-btn active" onclick="openTab(event, 'tab-selected')"><i class="fas fa-check-circle"></i> Selected</button>
    <button class="btn btn-secondary tab-btn" onclick="openTab(event, 'tab-pending')"><i class="fas fa-clock"></i> Pending</button>
    <button class="btn btn-secondary tab-btn" onclick="openTab(event, 'tab-rejected')"><i class="fas fa-times-circle"></i> Not Selected</button>
    <button class="btn btn-secondary tab-btn" onclick="openTab(event, 'tab-all')"><i class="fas fa-list"></i> All</button>
</div>

<!-- Tab Content: Selected -->
<div id="tab-selected" class="tab-content card">
    <h3>🎉 Selected Students List</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Company & Job</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hasSelected = false;
                foreach($apps as $a): 
                    if($a['status'] !== 'Selected') continue;
                    $hasSelected = true;
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($a['student_name']); ?></strong><br><small><?php echo $a['email']; ?></small></td>
                    <td><?php echo htmlspecialchars($a['company_name']); ?><br><small class="text-muted"><?php echo htmlspecialchars($a['job_title']); ?></small></td>
                    <td><?php echo date('M d, Y', strtotime($a['applied_at'])); ?></td>
                    <td><span class="badge bg-success">Selected</span></td>
                </tr>
                <?php endforeach; ?>
                <?php if(!$hasSelected): ?>
                    <tr><td colspan="4" style="text-align:center; padding:20px;">No students selected yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Tab Content: Pending -->
<div id="tab-pending" class="tab-content card" style="display:none;">
    <h3>⏳ Pending & In-Process</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Company & Job</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hasPending = false;
                foreach($apps as $a): 
                    if($a['status'] == 'Selected' || $a['status'] == 'Rejected') continue;
                    $hasPending = true;
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($a['student_name']); ?></strong><br><small><?php echo $a['email']; ?></small></td>
                    <td><?php echo htmlspecialchars($a['company_name']); ?><br><small class="text-muted"><?php echo htmlspecialchars($a['job_title']); ?></small></td>
                    <td><span class="badge bg-warning"><?php echo $a['status']; ?></span></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="app_id" value="<?php echo $a['id']; ?>">
                            <input type="hidden" name="update_status" value="1">
                            <button type="submit" name="status" value="Selected" class="btn btn-sm btn-success" title="Mark Selected"><i class="fas fa-check"></i></button>
                            <button type="submit" name="status" value="Rejected" class="btn btn-sm btn-danger" title="Reject"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                 <?php if(!$hasPending): ?>
                    <tr><td colspan="4" style="text-align:center; padding:20px;">No pending applications.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Tab Content: Rejected -->
<div id="tab-rejected" class="tab-content card" style="display:none;">
    <h3>❌ Not Selected / Rejected</h3>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Company & Job</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hasRejected = false;
                foreach($apps as $a): 
                    if($a['status'] !== 'Rejected') continue;
                    $hasRejected = true;
                ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($a['student_name']); ?></strong><br><small><?php echo $a['email']; ?></small></td>
                    <td><?php echo htmlspecialchars($a['company_name']); ?><br><small class="text-muted"><?php echo htmlspecialchars($a['job_title']); ?></small></td>
                    <td><?php echo date('M d, Y', strtotime($a['applied_at'])); ?></td>
                    <td><span class="badge bg-danger">Rejected</span></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="app_id" value="<?php echo $a['id']; ?>">
                            <input type="hidden" name="update_status" value="1">
                            <!-- Helper to undo rejection -->
                            <button type="submit" name="status" value="Pending" class="btn btn-sm btn-secondary" title="Moving to Pending"><i class="fas fa-undo"></i> Undo</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(!$hasRejected): ?>
                    <tr><td colspan="5" style="text-align:center; padding:20px;">No rejected applications.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Tab Content: All -->
<div id="tab-all" class="tab-content card" style="display:none;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
        <h3>📁 All Applications History</h3>
        <input type="text" id="allInput" onkeyup="filterTable('allInput', 'allTable')" placeholder="Search..." class="form-control" style="width:250px;">
    </div>
    <div class="table-responsive">
        <table class="table" id="allTable">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Job Profile</th>
                    <th>Company</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($apps as $a): ?>
                <tr>
                    <td><?php echo htmlspecialchars($a['student_name']); ?></td>
                    <td><?php echo htmlspecialchars($a['job_title']); ?></td>
                    <td><?php echo htmlspecialchars($a['company_name']); ?></td>
                    <td>
                        <?php 
                        $color = 'bg-info';
                        if($a['status']=='Selected') $color='bg-success';
                        elseif($a['status']=='Rejected') $color='bg-danger';
                        elseif($a['status']=='Applied') $color='bg-secondary';
                        elseif($a['status']=='Pending') $color='bg-warning';
                        ?>
                        <span class="badge <?php echo $color; ?>"><?php echo $a['status']; ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        tablinks[i].classList.remove("btn-primary");
        tablinks[i].classList.add("btn-secondary");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.classList.remove("btn-secondary");
    evt.currentTarget.classList.add("btn-primary");
    evt.currentTarget.className += " active";
}
</script>

<?php require_once '../includes/footer.php'; ?>
