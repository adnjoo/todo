<?php
include_once '../src/functions.php';

// check if the user is logged in
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
<div class="container mt-5">
    <?php if ($isLoggedIn): ?>
        <!-- Display the logged-in user's name -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <h2 class="mb-4">To-Do List</h2>

        <!-- Task form -->
        <form method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Enter a new task" required>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
        </form>

        <!-- Task list -->
        <ul class="list-group">
            <?php foreach ($tasks as $task): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="<?= $task['status'] ? 'text-decoration-line-through text-muted' : '' ?>">
                        <?= htmlspecialchars($task['task']) ?>
                    </span>
                    <div>
                        <?php if (!$task['status']): ?>
                            <form method="POST" style="display:inline;">
                                <button name="complete" value="<?= $task['id'] ?>" class="btn btn-success btn-sm">✔️ Complete</button>
                            </form>
                        <?php endif; ?>
                        <form method="POST" style="display:inline;">
                            <button name="delete" value="<?= $task['id'] ?>" class="btn btn-danger btn-sm">🗑️ Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <!-- Show message for users not logged in -->
        <div class="text-center">
            <h1>Welcome to the To-Do List App</h1>
            <p class="lead">You need to log in to manage your tasks.</p>
            <a href="login.php" class="btn btn-primary">Click here to log in</a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>