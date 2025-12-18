<?php
require_once 'config/db.php';

// Configuration
$num_students = 30;
$num_faculty = 5;
$num_companies = 10;
$num_recruiters = 5;

$password_plain = 'password';
$password_hash = password_hash($password_plain, PASSWORD_BCRYPT);

// Realistic Data Arrays
$first_names = ["Aarav", "Vivaan", "Aditya", "Vihaan", "Arjun", "Sai", "Reyansh", "Ayaan", "Krishna", "Ishaan", "Diya", "Saanvi", "Ananya", "Aadhya", "Pari", "Kiara", "Myra", "Riya", "Anya", "Saanvi"];
$last_names = ["Sharma", "Verma", "Gupta", "Malhotra", "Bhatia", "Saxena", "Mehta", "Joshi", "Singh", "Patel", "Reddy", "Nair", "Iyer", "Rao", "Kumar", "Das", "Chopra", "Khanna", "Jain", "Agarwal"];

$faculty_names = ["Dr. R.K. Mishra", "Prof. Sunita Sharma", "Dr. Amit Patil", "Prof. Neha Gupta", "Dr. Vikram Singh"];
$company_names = ["TCS", "Infosys", "Wipro", "Google", "Microsoft", "Amazon", "Flipkart", "Accenture", "Capgemini", "Deloitte"];
$recruiter_names = ["John Smith", "Emily Davis", "Robert Wilson", "Sarah Brown", "Michael Lee"];
$job_roles = ["Software Engineer", "Data Analyst", "Web Developer", "System Engineer", "Business Analyst", "Marketing Associate", "HR Trainee"];

echo "<h1>Starting Fresh Data Seeding...</h1>";
echo "<p>Default password for all users is: <b>password</b></p>";

try {
    $pdo->beginTransaction();

    // 0. Clear Existing Data (Optional - be careful in prod, but safe for dev)
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE applications");
    $pdo->exec("TRUNCATE TABLE student_details");
    $pdo->exec("TRUNCATE TABLE jobs");
    $pdo->exec("TRUNCATE TABLE users");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    
    // Create Admin
    $pdo->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?,?,?,?,?, 'active')")
        ->execute(['admin', 'admin@portal.com', $password_hash, 'System Administrator', 'admin']);
    echo "Created Admin.<br>";

    // 1. Create Faculty
    echo "Creating $num_faculty Faculty...<br>";
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?,?,?,?,?, 'approved')");
    
    foreach ($faculty_names as $i => $name) {
        $username = strtolower(str_replace([' ', '.'], '', $name)); // drrkmishra
        $email = $username . "@college.edu";
        $stmt->execute([$username, $email, $password_hash, $name, "faculty"]);
    }

    // 2. Create Companies
    echo "Creating $num_companies Companies...<br>";
    $company_ids = [];
    foreach ($company_names as $i => $name) {
        $username = strtolower($name);
        $email = "careers@" . $username . ".com";
        $stmt->execute([$username, $email, $password_hash, "$name Inc.", "company"]);
        $company_id = $pdo->lastInsertId();
        $company_ids[] = $company_id;
        
        // Post 1-2 jobs per company
        $stmt_job = $pdo->prepare("INSERT INTO jobs (title, description, company_name, posted_by) VALUES (?, ?, ?, ?)");
        $num_jobs = rand(1, 2);
        for ($j=0; $j<$num_jobs; $j++) {
            $role = $job_roles[array_rand($job_roles)];
            $stmt_job->execute(["$role at $name", "We are looking for a talented $role to join our team.", $name, $company_id]);
        }
    }

    // 3. Create Recruiters
    echo "Creating $num_recruiters Recruiters...<br>";
    foreach ($recruiter_names as $i => $name) {
        $username = "recruiter" . ($i+1);
        $email = str_replace(' ', '.', strtolower($name)) . "@hiring.com";
        $stmt->execute([$username, $email, $password_hash, $name, "recruiter"]);
    }

    // 4. Create Students
    echo "Creating $num_students Students...<br>";
    $stmt_student = $pdo->prepare("INSERT INTO users (username, email, password, full_name, role, status) VALUES (?,?,?,?,?, ?)");
    $stmt_details = $pdo->prepare("INSERT INTO student_details (user_id, branch, cgpa, skills) VALUES (?, ?, ?, ?)");
    
    for ($i = 0; $i < $num_students; $i++) {
        $fname = $first_names[array_rand($first_names)];
        $lname = $last_names[array_rand($last_names)];
        $fullname = "$fname $lname";
        $username = strtolower($fname . $lname . rand(10,99));
        $email = $username . "@student.edu";
        
        // Mix status
        $r = rand(1, 100);
        if ($r <= 10) $status = 'pending';
        elseif ($r <= 15) $status = 'rejected';
        else $status = 'approved';

        $stmt_student->execute([$username, $email, $password_hash, $fullname, "student", $status]);
        $student_id = $pdo->lastInsertId();
        
        // Add Details
        $branch = ($i % 2 == 0) ? 'Computer Science' : 'Electronics';
        $cgpa = rand(650, 980) / 100; // 6.50 - 9.80
        $stmt_details->execute([$student_id, $branch, $cgpa, "Java, Python, SQL"]);
    }

    $pdo->commit();
    echo "<h2 style='color:green'>Data Reset & Seeded Successfully!</h2>";
    echo "<ul>
            <li>5 Faculty (e.g., Dr. R.K. Mishra)</li>
            <li>10 Companies (e.g., TCS, Google)</li>
            <li>5 Recruiters</li>
            <li>30 Students (Mixed Approved/Pending)</li>
          </ul>";
    echo "<br><a href='admin/dashboard.php' class='btn'>Go to Dashboard</a>";

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "<h2 style='color:red'>Failed: " . $e->getMessage() . "</h2>";
}
?>
