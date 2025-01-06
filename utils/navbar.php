<nav id="navbar" class="bg-gray-900 mb-5 shadow-md sticky top-0 z-50">
  <div class="container mx-auto py-4 px-4 flex items-center justify-between">
    <!-- User Info -->
    <div class="flex items-center space-x-4">
      <a href="../profile/index.php" class="py-1 px-1 hover:bg-gray-700 rounded-full transition">
        <img src="../../assets/upload/<?= !empty($user['gambar']) ? $user['gambar'] : 'default.jpg' ?>" alt="User Avatar" class="w-10 h-10 rounded-full">
      </a>
      <div class="hidden sm:block">
        <h2 class="text-lg sm:text-2xl font-semibold text-gray-200">Selamat Datang</h2>
        <p class="text-gray-400 text-xs"><?= htmlspecialchars($user['username']); ?></p>
      </div>
    </div>

    <!-- Navigation Links (Desktop) -->
    <ul class="hidden md:flex space-x-8 text-white">
      <li><a href="../dashboard/index.php" class="py-2 px-4 rounded hover:bg-gray-700 transition">Beranda</a></li>
      <li><a href="../tugas/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Tugas</a></li>
      <li><a href="../forum/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Forum</a></li>
    </ul>

    <!-- Theme Color Picker -->
    <div class="flex items-center space-x-2">
      <label for="color-input" class="text-sm text-gray-200">Theme:</label>
      <input type="color" id="color-input" class="h-8 w-8 border-0 rounded-full focus:ring focus:ring-blue-500">
      <button id="save-color" class="py-2 px-4 hover:bg-gray-700 rounded transition">Simpan</button>
    </div>

    <!-- Dropdown Toggle for Mobile -->
    <div class="md:hidden">
      <button id="menu-toggle" class="p-2 text-gray-400 hover:text-white focus:outline-none">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>

    <!-- Logout Button -->
    <div class="hidden md:block">
      <a href="../../logout.php" class="py-2 px-4 text-red-600 hover:bg-red-100 rounded transition">Logout</a>
    </div>
  </div>

  <!-- Mobile Dropdown Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-gray-800">
    <ul class="flex flex-col space-y-4 p-4 text-white">
      <li><a href="../dashboard/index.php" class="py-2 px-4 rounded hover:bg-gray-700 transition">Beranda</a></li>
      <li><a href="../tugas/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Tugas</a></li>
      <li><a href="../forum/index.php" class="py-2 px-4 hover:bg-gray-700 rounded transition">Diskusi</a></li>
      <li><a href="../../logout.php" class="py-2 px-4 text-red-600 hover:bg-red-100 rounded transition">Logout</a></li>
    </ul>
  </div>
</nav>
