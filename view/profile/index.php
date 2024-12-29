<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect ke login jika belum login
  exit();
}

// Ambil data user dari database
include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="scale-50 sm:scale-75 lg:scale-100 bg-gray-900 text-white font-poppins h-screen flex items-center justify-center">
  <!-- Card Container -->
  <div class="bg-gray-800 w-full max-w-4xl rounded-lg p-6 shadow-lg">
    <!-- Header -->
    <div class="flex items-center gap-6">
      <img src="../../assets/upload/<?= !empty($user['gambar']) ? $user['gambar'] : 'default.jpg' ?>" alt="Avatar" class="w-24 h-24 rounded-full border-2 border-white">
      <div>
        <h2 class="text-2xl font-bold"><?php echo $user['username']; ?></h2>
        <p class="text-gray-400">D3 Sistem Informasi</p>
      </div>
      <div class="flex gap-8 text-center ml-auto">
        <div>
          <h3 class="text-xl font-bold">12</h3>
          <p class="text-gray-400">Pengikut</p>
        </div>
        <div>
          <h3 class="text-xl font-bold">4</h3>
          <p class="text-gray-400">Pesan</p>
        </div>
      </div>
    </div>

    <!-- Bio Section -->
    <div class="mt-6 text-lg">
      <h3 class="text-xl font-bold">Bio</h3>
      <p class="mt-2 text-gray-400">Seorang mahasiswa yang bersemangat di bidang Sistem Informasi dengan minat dalam pengembangan perangkat lunak dan desain UI/UX. Bersemangat untuk belajar dan berkolaborasi dalam proyek.</p>
    </div>

    <!-- Details Section -->
    <div class="mt-6 grid gap-4">
      <div class="flex items-center gap-4">
        <span class="text-lg">📍</span>
        <p class="leading-tight">Bandung<br><span class="text-gray-400">Telkom University</span></p>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-lg">📅</span>
        <p>Mata Kuliah (4)</p>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-lg">📞</span>
        <p>08123456789</p>
      </div>
    </div>

    <!-- Social Links -->
    <div class="mt-6">
      <h3 class="text-xl font-bold">Tautan Sosial</h3>
      <div class="flex gap-6 mt-2">
        <a href="#" class="text-blue-500 hover:text-blue-400">Facebook</a>
        <a href="#" class="text-blue-500 hover:text-blue-400">Twitter</a>
        <a href="#" class="text-blue-500 hover:text-blue-400">LinkedIn</a>
        <a href="#" class="text-blue-500 hover:text-blue-400">Instagram</a>
      </div>
    </div>

    <!-- Activity Summary -->
    <div class="mt-6">
      <h3 class="text-xl font-bold">Ringkasan Aktivitas</h3>
      <div class="grid gap-4 mt-2">
        <div class="flex justify-between">
          <p>Proyek Selesai</p>
          <p class="font-bold">15</p>
        </div>
        <div class="flex justify-between">
          <p>Keterampilan yang Diperoleh</p>
          <p class="font-bold">8</p>
        </div>
        <div class="flex justify-between">
          <p>Tugas Mendatang</p>
          <p class="font-bold">3</p>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="mt-10 text-center space-x-4">
      <a href="edit.php" class="inline-block text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Edit Profil</a>
      <a href="../dashboard/index.php" class="inline-block bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded">Kembali ke Dashboard</a>
      <a href="../../delete.php" class="inline-block bg-red-600 hover:bg-red-500 text-white py-2 px-4 rounded">Hapus Akun</a>
    </div>

  </div>
</body>

</html>