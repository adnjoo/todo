<?php
function renderTaskForm()
{
    ?>
    <form method="POST" class="mb-6">
        <div class="flex flex-col items-start gap-4">
            <input
                type="text"
                name="task"
                class="w-full p-3 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Enter a new task"
                required>
            <button
                type="submit"
                class="bg-blue-500 text-white rounded-lg hover:bg-blue-600 py-1 px-2">
                Add Task
            </button>
        </div>
    </form>
    <?php
}
