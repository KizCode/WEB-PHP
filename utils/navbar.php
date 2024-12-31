<aside class="flex text-xl justify-between items-center my-5 font-bold mb-10 bg-dark ">
  <div class="flex">
    <a href="../dashboard/index.php" class="hover:text-blue-400">Done</a>
  </div>
  <!-- Nav Section -->
  <div class="items-center">
    <ul class="flex text-center text-center gap-2 uppercase">
      <li><a href="../tugas/index.php" class="hover:text-blue-400">Tugas</a></li>
      <li><a href="../forum/index.php" class="hover:text-blue-400">Diskusi</a></li>
    </ul>
  </div>
  <!-- Profile Section -->
  <div class="relative">
    <button id="profileMenu" class="flex items-center gap-2 text-lg hover:text-blue-400">
      <span class="scale-0 md:scale-100 uppercase "><?= htmlspecialchars($user['username']); ?></span>
      <img src="../../assets/upload/<?= !empty($user['gambar']) ? $user['gambar'] : 'default.jpg' ?>" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white">
    </button>
    <ul id="dropdownMenu" class="hidden absolute right-0 mt-2 bg-gray-700 rounded-lg shadow-lg text-sm">
      <li><a href="../profile/index.php" class="block px-4 py-2 hover:bg-gray-600">Profile</a></li>
      <li><a href="#" class="block px-4 py-2 hover:bg-gray-600">Setting</a></li>
      <li><a href="../../logout.php" class="block px-4 py-2 hover:bg-gray-600">Logout</a></li>
    </ul>
  </div>
</aside>