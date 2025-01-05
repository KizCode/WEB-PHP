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

// Menjalankan query
$result = $conn->query($sql);

// Mengecek apakah query berhasil dijalankan
if ($result) {
  // Menghitung jumlah baris hasil query
  $count = $result->num_rows;
} else {
  $count = 0; // Jika query gagal, set jumlah menjadi 0
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="mx-auto bg-gray-800 min-h-screen text-white flex flex-col ">
  <!-- Main Content -->
  <main class="mb-auto">
    <?php include('../../utils/sidebar.php'); ?>
    <div class="container mb-auto mx-auto my-auto">
      <h1 class="text-5xl uppercase font-bold mb-4">Dashboard</h1>
      <!-- Breadcrumb -->
      <div class="mb-4 text-sm text-gray-100">
        <a href="#" class="hover:text-blue-500">Beranda</a>
        <span class="mx-2">/</span>
        <span>Dashboard</span>
      </div>
      <!-- Header -->
      <header class="flex justify-between items-center mb-6">
        <div>
          <h1 class="text-2xl font-bold">Welcome, <?= $user['username']; ?></h1>
          <p class="text-gray-400">Here is an overview of your activity.</p>
        </div>
        <div>
          <button class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700">Profile</button>
        </div>
      </header>

      <!-- Stats -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Tasks</h2>
          <p class="text-2xl font-bold"><?= $count ?></p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Completed</h2>
          <p class="text-2xl font-bold">0</p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Late</h2>
          <p class="text-2xl font-bold">0</p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Upcoming</h2>
          <p class="text-2xl font-bold">0</p>
        </div>
      </section>
    </div>
  </main>
  <?php include '../../utils/footer.php' ?>
</body>

</html>