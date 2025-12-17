<?php include 'actions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>📝 My To-Do List</h1>

    <!-- Input Form -->
    <form method="POST" action="actions.php" class="input-group">
        <?php if ($editId): ?>
            <!-- Update Mode -->
            <input type="hidden" name="task_id" value="<?php echo $editId; ?>">
            <input type="text" name="task" value="<?php echo htmlspecialchars($editTask); ?>" placeholder="Update your task..." autofocus required>
            <button type="submit" name="update_task" class="btn btn-update">Update</button>
            <a href="index.php" class="btn" style="background: #95a5a6; text-decoration: none; margin-left: 5px;">Cancel</a>
        <?php else: ?>
            <!-- Add Mode -->
            <input type="text" name="task" placeholder="What needs to be done?" autofocus required>
            <button type="submit" name="add_task" class="btn btn-add">Add Task</button>
        <?php endif; ?>
    </form>

    <!-- Task List -->
    <ul>
        <?php 
        $tasks = getTasks(); 
        if (!empty($tasks)):
            // Show latest first
            $tasks = array_reverse($tasks);
            foreach ($tasks as $t): 
        ?>
            <li>
                <span class="task-text"><?php echo htmlspecialchars($t['task']); ?></span>
                <div class="actions">
                    <a href="index.php?edit=<?php echo $t['id']; ?>" class="btn-edit">Edit</a>
                    <a href="actions.php?delete=<?php echo $t['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </li>
        <?php 
            endforeach; 
        else: 
        ?>
            <div class="empty-state">No tasks yet. Add one above!</div>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>
