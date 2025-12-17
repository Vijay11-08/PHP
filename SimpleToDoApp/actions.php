<?php
// File to store tasks
$jsonFile = 'tasks.json';

// Initialize file if not exists
if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, json_encode([]));
}

// Read Tasks
function getTasks() {
    global $jsonFile;
    $content = file_get_contents($jsonFile);
    return json_decode($content, true) ?? [];
}

// Add Task
if (isset($_POST['add_task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $tasks = getTasks();
        $tasks[] = ['task' => $task, 'id' => uniqid()]; // Add new task with ID
        file_put_contents($jsonFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }
    header("Location: index.php");
    exit();
}

// Delete Task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $tasks = getTasks();
    
    // Filter out the task with matching ID
    $tasks = array_filter($tasks, fn($t) => $t['id'] !== $id);
    
    // Re-index array
    $tasks = array_values($tasks);
    
    file_put_contents($jsonFile, json_encode($tasks, JSON_PRETTY_PRINT));
    header("Location: index.php");
    exit();
}

// Update Task
if (isset($_POST['update_task'])) {
    $id = $_POST['task_id'];
    $updatedText = trim($_POST['task']);
    
    if (!empty($updatedText)) {
        $tasks = getTasks();
        foreach ($tasks as &$t) {
            if ($t['id'] === $id) {
                $t['task'] = $updatedText;
                break;
            }
        }
        file_put_contents($jsonFile, json_encode($tasks, JSON_PRETTY_PRINT));
    }
    header("Location: index.php");
    exit();
}

// Get Single Task for Editing
$editTask = '';
$editId = '';
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $tasks = getTasks();
    foreach ($tasks as $t) {
        if ($t['id'] === $id) {
            $editTask = $t['task'];
            $editId = $t['id'];
            break;
        }
    }
}
?>
