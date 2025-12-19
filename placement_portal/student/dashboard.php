<?php
require_once '../includes/auth.php';
require_once '../config/db.php';
checkAuth('student');

$user_id = $_SESSION['user_id'];
$jobs = $pdo->query("SELECT * FROM jobs WHERE status='approved' ORDER BY created_at DESC")->fetchAll();
$applied_stmt = $pdo->prepare("SELECT job_id FROM applications WHERE student_id = ?");
$applied_stmt->execute([$user_id]);
$applied_jobs = $applied_stmt->fetchAll(PDO::FETCH_COLUMN);

$pageTitle = "Student Jobs";
require_once '../includes/header.php';
require_once '../includes/sidebar.php';
?>

<div class="page-header">
    <h1 class="page-title">Available Placement Drives</h1>
</div>

<div style="margin-bottom: 20px;">
    <!-- Simple search filter for card grids is harder with table script, let's just keep it simple or use a different script. 
         But request was "search or sort". 
         I'll add a simple JS filter for these cards too. 
    -->
    <input type="text" id="jobSearch" onkeyup="filterCards()" placeholder="Search Jobs..." class="form-control" style="max-width: 300px;">
</div>

<div id="jobGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
    <?php foreach($jobs as $job): ?>
        <div class="card job-card">
            <h3><?php echo htmlspecialchars($job['title']); ?></h3>
            <p style="font-weight: bold; color: var(--primary);"><?php echo htmlspecialchars($job['company_name']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($job['description'])); ?></p>
            
            <?php if(in_array($job['id'], $applied_jobs)): ?>
                <button class="btn btn-success btn-sm" disabled><i class="fas fa-check"></i> Applied</button>
            <?php else: ?>
                <a href="apply.php?id=<?php echo $job['id']; ?>" class="btn btn-primary btn-sm">Apply Now</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <?php if(empty($jobs)): ?>
       <p>No active placement drives.</p>
    <?php endif; ?>
</div>

<script>
function filterCards() {
    var input = document.getElementById("jobSearch");
    var filter = input.value.toUpperCase();
    var cards = document.getElementsByClassName("job-card");

    for (var i = 0; i < cards.length; i++) {
        var txtValue = cards[i].textContent || cards[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>

<?php require_once '../includes/footer.php'; ?>
