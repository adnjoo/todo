<?php
include_once '../config/config.php';

$config = [
    'app_name' => 'Todo App',
];

// Fetch tasks
function getTasks($pdo, $userId, $includeArchived = false) {
    $query = "SELECT * FROM tasks WHERE user_id = :user_id AND archived = 0 ORDER BY created_at DESC";
    if ($includeArchived) {
        $query = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC";
    }
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a task
function addTask($pdo, $task, $userId) {
    $stmt = $pdo->prepare("INSERT INTO tasks (task, user_id) VALUES (:task, :user_id)");
    $stmt->execute([
        'task' => $task,
        'user_id' => $userId,
    ]);
}

// Edit a task
function editTask($pdo, $taskId, $newTask, $userId) {
    $stmt = $pdo->prepare("UPDATE tasks SET task = :task WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'task' => $newTask,
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

// Mark task as complete
function completeTask($pdo, $taskId, $userId) {
    $stmt = $pdo->prepare("UPDATE tasks SET status = 1 WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

// Delete a task
function deleteTask($pdo, $taskId, $userId) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}

// Archive a task
function archiveTask($pdo, $taskId, $userId) {
    $stmt = $pdo->prepare("UPDATE tasks SET archived = 1 WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $taskId,
        'user_id' => $userId,
    ]);
}
?>
