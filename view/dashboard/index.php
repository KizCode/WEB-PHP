<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../../login.php"); // Redirect ke login jika belum login
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

<body class="mx-auto bg-[color:var(--main-color)] min-h-screen text-white flex flex-col transition duration-500">
  <!-- Main Content -->
  <main class="mb-auto">
    <?php include('../../utils/navbar.php'); ?>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl uppercase font-bold mb-6 text-start">Beranda</h1>
      <!-- Breadcrumb -->
      <div class="mb-4 text-sm text-gray-100 flex flex-wrap items-center ml-auto text-right">
        <a href="#" class="hover:text-blue-500">Beranda</a>
        <span class="mx-2 flex items-center">
          /
          <svg class="ml-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd" />
          </svg>
        </span>
      </div>

      <!-- Header -->
      <header class="flex flex-wrap justify-between items-center mb-6">
        <div class="mb-4 md:mb-0">
          <h1 class="text-xl sm:text-2xl font-bold">Welcome, <?= $user['username']; ?></h1>
          <p class="text-gray-400 text-sm sm:text-base">Here is an overview of your activity.</p>
        </div>
      </header>

      <!-- Stats -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <h2 class="text-base sm:text-lg font-semibold">Tasks</h2>
          <p class="text-xl sm:text-2xl font-bold"><?= $count ?></p>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <h2 class="text-base sm:text-lg font-semibold">Completed</h2>
          <p class="text-xl sm:text-2xl font-bold">0</p>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <h2 class="text-base sm:text-lg font-semibold">Late</h2>
          <p class="text-xl sm:text-2xl font-bold">0</p>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <h2 class="text-base sm:text-lg font-semibold">Upcoming</h2>
          <p class="text-xl sm:text-2xl font-bold">0</p>
        </div>
      </section>

      <!-- Charts Section -->
      <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <canvas id="lineChart"></canvas>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <canvas id="barChart"></canvas>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <canvas id="doughnutChart"></canvas>
        </div>
        <div class="bg-gray-700 p-4 rounded-lg shadow-lg hover:scale-105 transition duration-300">
          <canvas id="pieChart"></canvas>
        </div>
      </section>
    </div>
  </main>
  <?php include '../../utils/footer.php' ?>
  <script>
    const lineChart = new Chart(document.getElementById('lineChart'), {
      type: 'line',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
          label: 'Activity',
          data: [10, 20, 15, 30, 25, 40],
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
        }],
      },
      options: {
        plugins: {
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            titleFont: {
              size: 14
            },
            bodyFont: {
              size: 12
            }
          }
        }
      }
    });

    const barChart = new Chart(document.getElementById('barChart'), {
      type: 'bar',
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
          label: 'Tasks',
          data: [5, 10, 8, 12, 15, 18],
          backgroundColor: 'rgba(54, 162, 235, 0.8)',
        }],
      },
    });

    const doughnutChart = new Chart(document.getElementById('doughnutChart'), {
      type: 'doughnut',
      data: {
        labels: ['Completed', 'Pending', 'Late'],
        datasets: [{
          label: 'Status',
          data: [50, 30, 20],
          backgroundColor: ['#4CAF50', '#FFC107', '#F44336'],
        }],
      },
    });

    const pieChart = new Chart(document.getElementById('pieChart'), {
      type: 'pie',
      data: {
        labels: ['Urgent', 'High', 'Medium', 'Low'],
        datasets: [{
          label: 'Priority',
          data: [10, 25, 35, 30],
          backgroundColor: ['#FF5722', '#FF9800', '#FFC107', '#8BC34A'],
        }],
      },
    });
  </script>
</body>

</html>