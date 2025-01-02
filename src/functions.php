<?php
include_once '../config/config.php';

$config = [
    'app_name' => 'Todo App',
];

// Fetch tasks
function getTasks($pdo, $userId, $includeArchived = false)
{
    $query = "SELECT * FROM tasks WHERE user_id = :user_id AND archived = 0 ORDER BY created_at DESC";
    if ($includeArchived) {
        $query = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a task
function addTask($pdo, $task, $userId)
{
    $stmt = $pdo->prepare("INSERT INTO tasks (task, user_id) VALUES (:task, :user_id)");
    $stmt->execute([
        'task' => $task,
        'user_id' => $userId,
    ]);
}

// Edit a task
function editTask($pdo, $taskId, $newTask, $newDueDate, $userId)
{
    $stmt = $pdo->prepare("
        UPDATE tasks 
        SET task = :task, due_date = :due_date 
        WHERE id = :id AND user_id = :user_id
    ");
    $stmt->execute([
        'task' => $newTask,
        'due_date' => $newDueDate,
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

// Mark task as complete
function toggleTaskStatus($pdo, $taskId, $userId)
{
    // Fetch the current status of the task
    $stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
    $currentStatus = $stmt->fetchColumn();

    if ($currentStatus === false) {
        // Task not found
        throw new Exception("Task not found or does not belong to the user.");
    }

    // Toggle the status: if 1 (complete), set to 0 (incomplete), and vice versa
    $newStatus = $currentStatus ? 0 : 1;

    // Update the status in the database
    $stmt = $pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'status' => $newStatus,
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}


// Delete a task
function deleteTask($pdo, $taskId, $userId)
{
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

// Archive a task
function archiveTask($pdo, $taskId, $userId)
{
    $stmt = $pdo->prepare("UPDATE tasks SET archived = 1 WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

function formatDueDate($dueDate)
{
    // Create a DateTime object from the string
    $dateTime = new DateTime($dueDate);

    // Format the date in a more readable format
    return $dateTime->format('F j, Y'); // e.g., January 3, 2025
}
