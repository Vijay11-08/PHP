<?php
require_once 'config/db.php';

try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS company_details (
            user_id INT PRIMARY KEY,
            website VARCHAR(255),
            industry VARCHAR(100),
            location VARCHAR(100),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );

        CREATE TABLE IF NOT EXISTS recruiter_details (
            user_id INT PRIMARY KEY,
            phone VARCHAR(20),
            designation VARCHAR(100),
            linkedin_url VARCHAR(255),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
    ");
    echo "<h1>Tables Created Successfully!</h1>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
