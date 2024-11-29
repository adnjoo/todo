<?php
include_once '../src/functions.php';

// Check if the user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    $isLoggedIn = false; // Flag for user login status
} else {
    $isLoggedIn = true; // Flag for user login status
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['task'])) {
            addTask($pdo, $_POST['task']);
        } elseif (isset($_POST['complete'])) {
            completeTask($pdo, $_POST['complete']);
        } elseif (isset($_POST['delete'])) {
            deleteTask($pdo, $_POST['delete']);
        }
    }
}

$tasks = $isLoggedIn ? getTasks($pdo) : [];
?>


<?php
$title = 'To-Do List'; // Dynamic title for the header
include_once '../src/views/header.php';
?>
<div class="max-w-4xl mx-auto mt-10 p-6 bg-gray-100 rounded shadow-lg">
    <?php if ($isLoggedIn): ?>
        <!-- Display the logged-in user's name -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
            <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
        </div>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">To-Do List</h2>

        <!-- Task form -->
        <form method="POST" class="mb-6">
            <div class="flex items-center gap-4">
                <input
                    type="text"
                    name="task"
                    class="w-full p-3 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter a new task"
                    required>
                <button
                    type="submit"
                    class="bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Add Task
                </button>
            </div>
        </form>

        <!-- Task list -->
        <ul class="space-y-4">
            <?php foreach ($tasks as $task): ?>
                <li class="flex justify-between items-center p-4 bg-white rounded shadow-sm border">
                    <span class="<?= $task['status'] ? 'line-through text-gray-400' : 'text-gray-700' ?>">
                        <?= htmlspecialchars($task['task']) ?>
                    </span>
                    <div class="flex space-x-2">
                        <?php if (!$task['status']): ?>
                            <form method="POST">
                                <button
                                    name="complete"
                                    value="<?= $task['id'] ?>"
                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                    ✔️ Complete
                                </button>
                            </form>
                        <?php endif; ?>
                        <form method="POST">
                            <button
                                name="delete"
                                value="<?= $task['id'] ?>"
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <!-- Show message for users not logged in -->
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