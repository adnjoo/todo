<?php
include_once '../config/config.php';

$config = [
    'app_name' => 'Todo App',
];

// Fetch tasks
function getTasks($pdo, $includeArchived = false) {
    $query = "SELECT * FROM tasks WHERE archived = 0 ORDER BY created_at DESC";
    if ($includeArchived) {
        $query = "SELECT * FROM tasks ORDER BY created_at DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a task
function addTask($pdo, $task) {
    $stmt = $pdo->prepare("INSERT INTO tasks (task) VALUES (:task)");
    $stmt->execute(['task' => $task]);
}

// Mark task as complete
function completeTask($pdo, $taskId) {
    $stmt = $pdo->prepare("UPDATE tasks SET status = 1 WHERE id = :id");
    $stmt->execute(['id' => $taskId]);
}

// Archive a task
function archiveTask($pdo, $taskId) {
    $stmt = $pdo->prepare("UPDATE tasks SET archived = 1 WHERE id = :id");
    $stmt->execute(['id' => $taskId]);
}
?>
