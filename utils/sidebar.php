<nav class="bg-gray-900 mb-5 shadow-md">
    <div class="container mx-auto py-4 flex items-center justify-between">
        <!-- User Info -->
        <div class="flex items-center space-x-4">
            <img src="../../assets/upload/<?= !empty($user['gambar']) ? $user['gambar'] : 'default.jpg' ?>" alt="User Avatar" class="w-10 h-10 rounded-full">
            <div>
                <h2 class="text-sm font-semibold text-gray-200">Selamat Datang</h2>
                <p class="text-gray-400 text-xs"><?= htmlspecialchars($user['username']); ?></p>
            </div>
        </div>

        <!-- Navigation Links -->
        <ul class="flex space-x-6 text-white">
            <li><a href="../dashboard/index.php" class="py-2 px-4 rounded hover:bg-gray-700 transition">Beranda</a></li>
            <li><a href="../tugas/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Tugas</a></li>
            <li><a href="../forum/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Diskusi</a></li>
            <li><a href="../profile/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Profile</a></li>
        </ul>

        <!-- Logout Button -->
        <div>
            <a href="../../logout.php" class="py-2 px-4 text-red-600 hover:bg-red-100 rounded transition">Logout</a>
        </div>
    </div>
</nav>
