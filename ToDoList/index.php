<?php
include 'config.php';

$result = $conn->query("SELECT * FROM tasks");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . htmlspecialchars($row['task']) . 
             ' <button class="edit_task" data-id="' . $row['id'] . '">Edit</button>' . 
             ' <button class="delete_task" data-id="' . $row['id'] . '">Delete</button>' . 
             '</li>';
    }
} else {
    echo '<li>No tasks found.</li>';
}
?>





