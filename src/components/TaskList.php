<?php
function renderTaskList($tasks)
{
    ?>
    <ul class="space-y-4">
        <?php foreach ($tasks as $task): ?>
            <li class="flex justify-between items-center p-4 bg-white rounded shadow-sm border">
                <span class="<?= $task['status'] ? 'line-through text-gray-400' : 'text-gray-700' ?>">
                    <?= htmlspecialchars($task['task']) ?>
                </span>
                <div class="relative">
                    <!-- Triple Dot Button -->
                    <button
                        onclick="toggleDropdown('dropdown-<?= $task['id'] ?>')"
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
                        <form method="POST" class="block w-full text-left">
                            <button
                                name="delete"
                                value="<?= $task['id'] ?>"
                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                🗑️ Delete
                            </button>
                        </form>
                        <form method="POST" class="block w-full text-left">
                            <button
                                name="archive"
                                value="<?= $task['id'] ?>"
                                class="w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                📂 Archive
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Dropdown Toggle Script -->
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
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
