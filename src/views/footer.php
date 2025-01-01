<!-- src/views/footer.php -->
<?php
include_once __DIR__ . '/../functions.php';
?>

<footer class="bg-light text-center py-3 mt-5">
    <p>&copy;<?= date('Y') ?> <?= htmlspecialchars($config['app_name']) ?>. All Rights Reserved.</p>
    <p>
        <a href="https://github.com/adnjoo/todo" target="_blank" rel="noopener noreferrer" class="text-decoration-none hover:underline">
            View on GitHub
        </a>
    </p>
</footer>
</body>
</html>
