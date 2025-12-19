<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');

$pageTitle = "Placement Drives";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Available Placement Drives</h1>
</div>

<?php
$user_id = $_SESSION['user_id'];

// Fetch all approved jobs
$stmt = $pdo->query("SELECT * FROM jobs WHERE status='approved' ORDER BY created_at DESC");
$jobs = $stmt->fetchAll();

// Fetch applied jobs for this student
$applied_stmt = $pdo->prepare("SELECT job_id FROM applications WHERE student_id = ?");
$applied_stmt->execute([$user_id]);
$applied_jobs = $applied_stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<div class="card">
    <div style="margin-bottom: 20px;">
        <input type="text" id="jobSearch" onkeyup="filterCards()" placeholder="Search Jobs..." class="form-control" style="max-width: 300px;">
    </div>

    <div id="jobGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        <?php foreach($jobs as $job): ?>
            <div class="card job-card" style="border: 1px solid #eee; padding: 15px; border-radius: 8px;">
                <h3><?php echo htmlspecialchars($job['title']); ?></h3>
                <p style="font-weight: bold; color: var(--primary);"><?php echo htmlspecialchars($job['company_name']); ?></p>
                <p><?php echo nl2br(htmlspecialchars(substr($job['description'], 0, 150))); ?>...</p> <!-- Truncate description -->
                
                <div style="margin-top: 10px;">
                    <?php if(in_array($job['id'], $applied_jobs)): ?>
                        <button class="btn btn-success btn-sm" disabled><i class="fas fa-check"></i> Applied</button>
                    <?php else: ?>
                        <a href="apply.php?id=<?php echo $job['id']; ?>" class="btn btn-primary btn-sm">Apply Now</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if(empty($jobs)): ?>
           <p>No active placement drives found.</p>
        <?php endif; ?>
    </div>
</div>

<script>
function filterCards() {
    var input = document.getElementById("jobSearch");
    var filter = input.value.toUpperCase();
    var cards = document.getElementsByClassName("job-card");

    for (var i = 0; i < cards.length; i++) {
        var title = cards[i].getElementsByTagName("h3")[0];
        var company = cards[i].getElementsByTagName("p")[0];
        if (title || company) {
            var txtValue = (title.textContent || title.innerText) + " " + (company.textContent || company.innerText);
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
}
</script>

<?php require_once '../includes/footer.php'; ?>
