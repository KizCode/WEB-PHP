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

// Menulis query untuk mengambil data tugas
$sql = "SELECT * FROM tasks";

// Menjalankan query
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      zoom: 150%;
    }
  </style>
</head>

<body class="bg-gray-800 text-white font-poppins">
  <!-- Navbar -->
  <?php include('../../utils/navbar.php'); ?>

  <!-- Header -->
  <header class="my-6 mx-10 text-start">
    <h1 class="text-3xl font-bold">Hello, <?= $user['username']; ?></h1>
  </header>

  <!-- Main Content -->
  <div class="grid gap-8 px-4 mx-6 grid-cols-1 lg:grid-cols-3">
    <!-- Deadlines -->
    <section class="bg-gray-900 p-6 rounded-lg">
      <h2 class="text-lg font-semibold uppercase">Deadline Time</h2>
      <div class="mt-4 space-y-6">
        <div>
          <h3 class="text-md font-medium">Friday, 26 April 2024</h3>
          <div class="mt-2 space-y-2">
            <label class="flex items-center">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
              <span class="ml-2">Default checkbox</span>
            </label>
            <label class="flex items-center">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
              <span class="ml-2">Default checkbox</span>
            </label>
          </div>
        </div>
        <div>
          <h3 class="text-md font-medium">Saturday, 27 April 2024</h3>
          <label class="flex items-center mt-2">
            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
            <span class="ml-2">Default checkbox</span>
          </label>
        </div>
      </div>
    </section>

    <!-- Subjects and Current Project -->
    <div class="lg:col-span-2 space-y-6">
      <section class="bg-gray-900 p-6 rounded-lg">
        <h2 class="text-lg font-semibold uppercase">Mata Kuliah</h2>
        <div class="mt-4 grid grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="bg-gray-700 h-24 rounded-lg flex items-center justify-center">Matdis</div>
          <div class="bg-gray-700 h-24 rounded-lg flex items-center justify-center">Basis Data</div>
          <div class="bg-gray-700 h-24 rounded-lg flex items-center justify-center">Alpro</div>
          <div class="bg-gray-700 h-24 rounded-lg flex items-center justify-center">IUXD</div>
        </div>
      </section>

      <section class="bg-gray-900 p-6 rounded-lg">
        <h2 class="text-lg font-semibold uppercase">Daftar Tugas</h2>
        <div class="mt-4 flex justify-between">
          <button class="px-4 py-2 bg-gray-600 w-full m-2 rounded-lg">Not Finished Yet</button>
          <button class="px-4 py-2 bg-green-700 w-full m-2 rounded-lg">Finished</button>
          <button class="px-4 py-2 bg-red-600 w-full m-2 rounded-lg">Late</button>
        </div>
      </section>
    </div>
  </div>
</body>
<?php include '../../footer.php'; ?>
</html>
