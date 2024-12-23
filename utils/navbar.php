<nav class="flex justify-between items-center p-4 bg-gray-900">
  <div class="flex items-center">
  </div>
    <ul class="flex items-center gap-4 uppercase">
      <li><a href="../tugas/create.php" class="hover:text-blue-400">Upload</a></li>
      <li><a href="../chat/chat.php" class="hover:text-blue-400">Discuss</a></li>
    </ul>

    <!-- Profile Section -->
    <div class="relative">
      <button id="profileMenu" class="flex items-center gap-2 text-lg hover:text-blue-400">
        <span><?= htmlspecialchars($user['username']); ?></span>
        <img src="../../assets/upload/<?= !empty($user['gambar']) ? $user['gambar'] : 'default.jpg' ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white">
      </button>
      <ul id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-gray-700 rounded-lg shadow-lg text-sm">
        <li><a href="../profile/index.php" class="block px-4 py-2 hover:bg-gray-600">Profile</a></li>
        <li><a href="#" class="block px-4 py-2 hover:bg-gray-600">Setting</a></li>
        <li><a href="logout.php" class="block px-4 py-2 hover:bg-gray-600">Logout</a></li>
      </ul>
    </div>
  </nav>