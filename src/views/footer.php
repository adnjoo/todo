<!-- src/views/footer.php -->
<?php
include_once __DIR__ . '/../functions.php';
?>

<footer class="bg-light text-center py-3 mt-5">
    <p>&copy;<?= date('Y') ?> <?= htmlspecialchars($config['app_name']) ?>. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
