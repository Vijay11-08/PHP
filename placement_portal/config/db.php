<?php
$host = 'localhost';
$db_name = 'placement_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<h3>Database Connection Failed</h3><p>Please import <code>placement_db.sql</code> into phpMyAdmin.</p>" . $e->getMessage());
}
?>
