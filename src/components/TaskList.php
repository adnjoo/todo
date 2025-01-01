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
                            name="archive"
                            value="<?= $task['id'] ?>"
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            📂 Archive
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}
