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
$sql = "SELECT * FROM tugas";

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
</head>

<body class="mx-auto bg-gray-800 min-h-screen text-white flex flex-col">
  <!-- Navbar -->
  <?php include('../../utils/navbar.php'); ?>
  <div class="mx-9 mb-auto">
    <!-- Header -->
    <header class="my-6 mx-5 text-start">
      <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold">Hello, <?= $user['username']; ?></h1>
    </header>
    
    <!-- Main Content -->
    <div class="grid gap-4 sm:gap-6 lg:gap-8 px-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 flex-1">
      <!-- Deadlines -->
      <section class="col-span-1 sm:col-span-2 lg:col-span-1 bg-gray-900 p-4 sm:p-6 rounded-lg mb-auto">
        <h2 class="text-md sm:text-lg font-semibold uppercase">Deadline Time</h2>
        <div class="mt-4 space-y-4 sm:space-y-6">
          <div>
            <h3 class="text-sm sm:text-md font-medium">Friday, 26 April 2024</h3>
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
            <h3 class="text-sm sm:text-md font-medium">Saturday, 27 April 2024</h3>
            <label class="flex items-center mt-2">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
              <span class="ml-2">Default checkbox</span>
            </label>
          </div>
        </div>
      </section>
  
      <!-- Subjects and Current Project -->
      <div class="col-span-1 sm:col-span-2 lg:col-span-2 space-y-6">
        <section class="bg-gray-900 p-4 sm:p-6 rounded-lg">
          <h2 class="text-lg sm:text-xl font-semibold uppercase">Mata Kuliah</h2>
          <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-700 h-12 lg:h-24 rounded-lg flex items-center justify-center">Matdis</div>
            <div class="bg-gray-700 h-12 lg:h-24 rounded-lg flex items-center justify-center">Basis Data</div>
            <div class="bg-gray-700 h-12 lg:h-24 rounded-lg flex items-center justify-center">Alpro</div>
            <div class="bg-gray-700 h-12 lg:h-24 rounded-lg flex items-center justify-center">IUXD</div>
          </div>
        </section>
  
        <section class="bg-gray-900 p-4 sm:p-6 rounded-lg">
          <h2 class="text-lg sm:text-xl font-semibold uppercase">Daftar Tugas</h2>
          <div class="mt-4 flex flex-col sm:flex-row justify-between">
            <button class="px-4 py-2 bg-gray-600 w-full my-2 sm:my-2 md:mx-2 rounded-lg">Not Finished Yet</button>
            <button class="px-4 py-2 bg-green-700 w-full my-2 sm:my-2  md:mx-2 rounded-lg">Finished</button>
            <button class="px-4 py-2 bg-red-600 w-full my-2 sm:my-2  md:mx-2 rounded-lg">Late</button>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include '../../footer.php'; ?>
</body>

</html>
