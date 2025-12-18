<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('admin');

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM users WHERE id=?")->execute([$id]);
    header("Location: manage_users.php?msg=Deleted");
}

$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();

$pageTitle = "Manage Users";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Manage Users</h1>
    <a href="add_user.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New User</a>
</div>

<div class="card">
    <div style="margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
        <!-- Rows Selector -->
        <select id="rowsPerPage" class="form-control" style="width: auto; margin-right: 10px;">
            <option value="10">10 rows</option>
            <option value="20">20 rows</option>
            <option value="25">25 rows</option>
            <option value="50">50 rows</option>
        </select>
        
        <input type="text" id="userInput" placeholder="Search name or email..." class="form-control" style="flex: 1; min-width: 200px;">
        
        <!-- Existing Filters (PHP based) -->
        <select id="roleFilter" onchange="applyPhpFilters()" class="form-control" style="width: auto; min-width: 150px;">
            <option value="">All Roles</option>
            <option value="student" <?php echo (isset($_GET['role']) && $_GET['role']=='student') ? 'selected' : ''; ?>>Student</option>
            <option value="faculty" <?php echo (isset($_GET['role']) && $_GET['role']=='faculty') ? 'selected' : ''; ?>>Faculty</option>
            <option value="company" <?php echo (isset($_GET['role']) && $_GET['role']=='company') ? 'selected' : ''; ?>>Company</option>
            <option value="recruiter" <?php echo (isset($_GET['role']) && $_GET['role']=='recruiter') ? 'selected' : ''; ?>>Recruiter</option>
        </select>

        <select id="statusFilter" onchange="applyPhpFilters()" class="form-control" style="width: auto; min-width: 150px;">
            <option value="">All Statuses</option>
            <option value="approved" <?php echo (isset($_GET['status']) && $_GET['status']=='approved') ? 'selected' : ''; ?>>Approved</option>
            <option value="pending" <?php echo (isset($_GET['status']) && $_GET['status']=='pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="rejected" <?php echo (isset($_GET['status']) && $_GET['status']=='rejected') ? 'selected' : ''; ?>>Rejected</option>
        </select>
    </div>

    <div class="table-responsive">
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Details</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u): ?>
                <tr data-role="<?php echo strtolower($u['role']); ?>" data-status="<?php echo strtolower($u['status']); ?>">
                    <td><?php echo $u['id']; ?></td>
                    <td>
                        <strong><?php echo htmlspecialchars($u['full_name']); ?></strong> <br>
                        <small class="text-muted">@<?php echo htmlspecialchars($u['username']); ?></small> <br>
                        <small><?php echo htmlspecialchars($u['email']); ?></small>
                    </td>
                    <td><span class="badge bg-info"><?php echo ucfirst($u['role']); ?></span></td>
                    <td>
                        <?php if($u['status']=='approved'): ?>
                            <span class="badge bg-success">Approved</span>
                        <?php elseif($u['status']=='pending'): ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $u['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <a href="manage_users.php?delete=<?php echo $u['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?');"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:15px;">
        <div id="userTable_info" style="color:#666;"></div>
        <div id="userTable_pagination"></div>
    </div>
</div>

<script>
// Separate handling for PHP Filters vs JS Search/Pagination
function applyPhpFilters() {
    var role = document.getElementById("roleFilter").value;
    var status = document.getElementById("statusFilter").value;
    window.location.href = "manage_users.php?role=" + role + "&status=" + status;
}

// Initialize JS Pagination
window.addEventListener('load', function() {
    window.tableManagers['userTable'] = new TableManager({
        tableId: 'userTable',
        searchId: 'userInput',
        rowsSelectId: 'rowsPerPage',
        paginationId: 'userTable_pagination'
    });
});
</script>

<?php require_once '../includes/footer.php'; ?>
