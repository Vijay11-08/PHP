<?php
session_start();

define('USER_FILE', __DIR__ . '/users.json');

// Initialize users file if missing
if (!file_exists(USER_FILE)) {
    file_put_contents(USER_FILE, json_encode([]));
}

// Get all users
function getUsers() {
    $content = file_get_contents(USER_FILE);
    return json_decode($content, true) ?? [];
}

// Save users
function saveUsers($users) {
    file_put_contents(USER_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

// Register User
function registerUser($username, $password) {
    $users = getUsers();
    
    // Check if user exists
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return "Username already taken.";
        }
    }

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $newUser = [
        'id' => uniqid(),
        'username' => $username,
        'password' => $hashedPassword,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $users[] = $newUser;
    saveUsers($users);
    return true;
}

// Login User
function loginUser($username, $password) {
    $users = getUsers();

    foreach ($users as $user) {
        if ($user['username'] === $username) {
            // Verify Password
            if (password_verify($password, $user['password'])) {
                // Set Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            } else {
                return "Invalid password.";
            }
        }
    }
    return "User not found.";
}

// Check Logic
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Protected Page Check
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}
?>
