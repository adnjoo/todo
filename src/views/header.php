<!DOCTYPE html>
<?php
include_once __DIR__ . '/../functions.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= htmlspecialchars($title ?? 'App Name') ?></title>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="index.php" class="text-white text-xl font-bold">
                        <?= htmlspecialchars($config['app_name'] ?? 'App Name') ?>
                    </a>
                </div>
                <div class="hidden md:flex space-x-4">
                    <a href="index.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="logout.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Logout
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Login
                        </a>
                    <?php endif; ?>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-toggle" class="text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                        ☰
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-gray-700">
            <a href="index.php" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                Home
            </a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Profile
                </a>
                <a href="logout.php" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                    Login
                </a>
            <?php endif; ?>
            <a href="https://github.com/adnjoo/todo" target="_blank" class="block text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                GitHub
            </a>
        </div>
    </nav>

    <script>
        // Toggle mobile menu visibility
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>