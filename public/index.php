<?php
include_once '../src/functions.php';
include_once '../src/components/TaskForm.php';
include_once '../src/components/TaskList.php';

session_start();

$isLoggedIn = isset($_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    if (isset($_POST['task'])) {
        addTask($pdo, $_POST['task'], $userId);
    } elseif (isset($_POST['complete'])) {
        completeTask($pdo, $_POST['complete'], $userId);
    } elseif (isset($_POST['delete'])) {
        deleteTask($pdo, $_POST['delete'], $userId);
    } elseif (isset($_POST['edit'])) {
        $taskId = $_POST['task_id'];
        $newTask = $_POST['updated_task'];
        $newDueDate = $_POST['updated_due_date'];

        // Call editTask with the new due date
        editTask($pdo, $taskId, $newTask, $newDueDate, $userId);
    } elseif (isset($_POST['archive'])) {
        archiveTask($pdo, $_POST['archive'], $userId);
    }
};

$tasks = $isLoggedIn ? getTasks($pdo, $_SESSION['user_id']) : [];

$title = 'To-Do List';
include_once '../src/views/header.php';
?>
<div class="max-w-4xl mx-auto mt-10 p-6 bg-gray-100 rounded shadow-lg min-h-96">
    <?php if ($isLoggedIn): ?>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">To-Do List</h2>
        <?php renderTaskForm(); ?>
        <?php renderTaskList($tasks); ?>
    <?php else: ?>
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to the To-Do List App</h1>
            <p class="text-lg text-gray-600 mb-6">You need to log in to manage your tasks.</p>
            <a href="login.php" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Click here to log in
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include_once '../src/views/footer.php'; ?>