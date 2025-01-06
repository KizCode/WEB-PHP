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
$query = "SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Menulis query untuk mengambil data tugas
$sql = "SELECT * FROM tugas WHERE user_id = $user_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="mx-auto bg-[color:var(--main-color)]  text-white min-h-screen flex flex-col">
  <?php include '../../utils/navbar.php'; ?>

  <!-- Card Container -->
  <div class="bg-gray-800 p-6 sm:p-8 lg:p-10 container rounded-lg mx-auto">
    <h1 class="text-2xl sm:text-3xl lg:text-4xl uppercase font-bold mb-6 text-center sm:text-left">Profile</h1>

    <!-- Breadcrumb -->
    <div class="mb-4 text-sm text-gray-100 flex flex-wrap items-center">
      <a href="#" class="hover:text-blue-500">Beranda</a>
      <span class="mx-2 flex items-center">
        /
        <svg class="ml-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd" />
        </svg>
      </span>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 mb-8">
      <!-- Avatar -->
      <img src="../../assets/upload/<?= !empty($user['gambar']) ? htmlspecialchars($user['gambar']) : 'default.jpg' ?>" alt="Avatar" class="w-24 h-24 sm:w-24 sm:h-24  rounded-full border-4 border-white object-cover">

      <!-- User Info -->
      <div class="flex-1">
        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold"><?= htmlspecialchars($user['username']); ?></h2>
        <p class="text-gray-400">D3 Sistem Informasi</p>
      </div>

      <!-- User Stats -->
      <div class="flex flex-col sm:flex-row gap-6 text-center sm:text-left">
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
    <div class="mb-8">
      <h3 class="text-lg sm:text-xl font-semibold mb-2">Bio</h3>
      <p class="text-gray-400 leading-relaxed">
        Seorang mahasiswa yang bersemangat di bidang Sistem Informasi dengan minat dalam pengembangan perangkat lunak dan desain UI/UX. Bersemangat untuk belajar dan berkolaborasi dalam proyek.
      </p>
    </div>

    <?php 
      if ($result) {
        $jumlahTugas = $result->num_rows;
    ?>
    <!-- Details Section -->
    <div class="mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="flex items-center gap-4">
        <span class="text-2xl">📍</span>
        <p>
          Bandung<br>
          <span class="text-gray-400">Telkom University</span>
        </p>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-2xl">📅</span>
        <p><?= "Jumlah Tugas: $jumlahTugas" ?></p>
      </div>
      <div class="flex items-center gap-4">
        <span class="text-2xl">📞</span>
        <p>08123456789</p>
      </div>
    </div>
    <?php
      }
    ?>

    <!-- Social Links -->
    <div class="mb-8">
      <h3 class="text-lg sm:text-xl font-semibold mb-2">Tautan Sosial</h3>
      <div class="flex flex-wrap gap-4">
        <a href="#" class="text-blue-500 hover:text-blue-400 transition">Facebook</a>
        <a href="#" class="text-blue-500 hover:text-blue-400 transition">Twitter</a>
        <a href="#" class="text-blue-500 hover:text-blue-400 transition">LinkedIn</a>
        <a href="#" class="text-blue-500 hover:text-blue-400 transition">Instagram</a>
      </div>
    </div>

    <!-- Activity Summary -->
    <div class="mb-8">
      <h3 class="text-lg sm:text-xl font-semibold mb-4">Ringkasan Aktivitas</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="flex justify-between items-center bg-gray-800 p-4 rounded-lg">
          <p>Proyek Selesai</p>
          <p class="font-bold">15</p>
        </div>
        <div class="flex justify-between items-center bg-gray-800 p-4 rounded-lg">
          <p>Keterampilan yang Diperoleh</p>
          <p class="font-bold">8</p>
        </div>
        <div class="flex justify-between items-center bg-gray-800 p-4 rounded-lg">
          <p>Tugas Mendatang</p>
          <p class="font-bold">3</p>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col sm:flex-row justify-center sm:justify-start gap-4">
      <a href="edit.php" class="w-full sm:w-auto text-center bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition">Edit Profil</a>
      <a href="../dashboard/index.php" class="w-full sm:w-auto text-center bg-gray-700 hover:bg-gray-600 text-white py-2 px-4 rounded transition">Kembali ke Dashboard</a>
      <a href="../../delete.php" class="w-full sm:w-auto text-center bg-red-600 hover:bg-red-500 text-white py-2 px-4 rounded transition">Hapus Akun</a>
    </div>
  </div>
  <!-- Footer -->
  <?php include '../../utils/footer.php'; ?>
</body>

</html>


</html>