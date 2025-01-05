<?php
include_once __DIR__ . '/../functions.php';
?>

<footer class="bg-light text-center py-12 mt-5 border-t">
    <p>&copy;<?= date('Y') ?> <?= htmlspecialchars($config['app_name']) ?>. All Rights Reserved.</p>
    <a href="https://github.com/adnjoo/todo" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center mt-2">
        <img src="/assets/github.svg" alt="GitHub" className="h-6 w-6" />
    </a>
</footer>
</body>

</html>