<?php
function renderTaskList($tasks)
{
?>
    <ul class="space-y-4">
        <?php foreach ($tasks as $task): ?>
            <li class="flex justify-between items-center p-4 bg-white rounded shadow-sm border">
                <div>
                    <span id="task-text-<?= $task['id'] ?>" class="<?= $task['status'] ? 'line-through text-gray-400' : 'text-gray-700' ?>">
                        <?= htmlspecialchars($task['task']) ?>
                    </span>
                    <br>
                    <small id="task-due-date-<?= $task['id'] ?>" class="text-sm <?= $task['status'] ? 'text-gray-400' : 'text-gray-600' ?>">
                        Due: <?= formatDueDate($task['due_date']) ?>
                    </small>
                </div>

                <!-- Edit Form -->
                <form id="edit-form-<?= $task['id'] ?>" method="POST" class="hidden">
                    <div class="mb-2">
                        <label for="updated_task_<?= $task['id'] ?>" class="sr-only">Edit Task</label>
                        <input
                            id="updated_task_<?= $task['id'] ?>"
                            type="text"
                            name="updated_task"
                            value="<?= htmlspecialchars($task['task']) ?>"
                            class="border p-2 rounded w-full"
                            required>
                    </div>
                    <div class="mb-2">
                        <label for="updated_due_date_<?= $task['id'] ?>" class="sr-only">Edit Due Date</label>
                        <input
                            id="updated_due_date_<?= $task['id'] ?>"
                            type="date"
                            name="updated_due_date"
                            value="<?= htmlspecialchars((new DateTime($task['due_date']))->format('Y-m-d')) ?>"
                            class="border p-2 rounded w-full"
                            required>
                    </div>
                    <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                    <button
                        type="submit"
                        name="edit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Save
                    </button>
                    <button
                        type="button"
                        onclick="toggleEditForm('<?= $task['id'] ?>')"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                </form>

                <div class="relative">
                    <!-- Triple Dot Button -->
                    <button
                        onclick="toggleDropdown('dropdown-<?= $task['id'] ?>')"
                        aria-label="Task options"
                        class="bg-gray-200 hover:bg-gray-300 rounded-full p-2">
                        ⋮
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        id="dropdown-<?= $task['id'] ?>"
                        class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-10">
                        <?php if (!$task['status']): ?>
                            <form method="POST" class="block w-full text-left">
                                <button
                                    name="complete"
                                    value="<?= $task['id'] ?>"
                                    class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    ✔️ Mark as Complete
                                </button>
                            </form>
                        <?php endif; ?>
                        <form method="POST" class="block w-full">
                            <button
                                name="delete"
                                value="<?= $task['id'] ?>"
                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                                🗑️ Delete
                            </button>
                        </form>
                        <form method="POST" class="block w-full">
                            <button
                                name="archive"
                                value="<?= $task['id'] ?>"
                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                                📂 Archive
                            </button>
                        </form>
                        <button
                            onclick="toggleEditForm('<?= $task['id'] ?>')"
                            class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left">
                            ✏️ Edit
                        </button>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Scripts -->
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        function toggleEditForm(taskId) {
            const textElement = document.getElementById(`task-text-${taskId}`);
            const formElement = document.getElementById(`edit-form-${taskId}`);

            if (textElement.classList.contains('hidden')) {
                textElement.classList.remove('hidden');
                formElement.classList.add('hidden');
            } else {
                textElement.classList.add('hidden');
                formElement.classList.remove('hidden');
            }
        }

        // Close dropdowns if clicking outside
        document.addEventListener('click', (event) => {
            const dropdowns = document.querySelectorAll('[id^="dropdown-"]');
            dropdowns.forEach((dropdown) => {
                if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
<?php
}
?>