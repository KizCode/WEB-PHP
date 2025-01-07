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
  $count = $result->num_rows; // Total tugas
} else {
  $count = 0; // Jika query gagal, set jumlah menjadi 0
}

// Menghitung tugas berdasarkan status
$status_counts = [
  'Selesai' => 0,
  'Sedang Dikerjakan' => 0,
  'Terlambat' => 0,
];

while ($row = $result->fetch_assoc()) {
  if ($row['status'] === 'Selesai') {
    $status_counts['Selesai']++;
  } elseif ($row['status'] === 'Sedang Dikerjakan') {
    $status_counts['Sedang Dikerjakan']++;
  } elseif ($row['status'] === 'Terlambat') {
    $status_counts['Terlambat']++;
  }
}


// Database query to count activities grouped by month
$query = "SELECT DATE_FORMAT(created_at, '%M') AS month, COUNT(*) AS count
          FROM tugas
          GROUP BY month
          ORDER BY MIN(created_at)";
$result = mysqli_query($conn, $query);

// Prepare data for the chart
$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
  $labels[] = $row['month'];
  $data[] = $row['count'];
}

// Convert PHP arrays to JavaScript
$labels_json = json_encode($labels);
$data_json = json_encode($data);


// Ambil data mata kuliah
$query_mata_kuliah = "SELECT * FROM mata_kuliah WHERE user_id = $user_id";
$result_mata_kuliah = mysqli_query($conn, $query_mata_kuliah);

// Ambil data tugas
$query_tugas = "SELECT * FROM tugas WHERE user_id = $user_id";
$result_tugas = mysqli_query($conn, $query_tugas);

// Periksa apakah request valid
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tugas'])) {
  $id_tugas = $_POST['id_tugas'];
  $status = $_POST['status'];

  // Update status di database
  $query = "UPDATE tugas SET status = '$status' WHERE id_tugas = $id_tugas";
  if (mysqli_query($conn, $query)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
  }
  exit();
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

      <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-bold text-gray-200">Total Tugas</h2>
          <p class="text-3xl font-semibold text-blue-600"><?= $count ?></p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-bold text-gray-200">Selesai</h2>
          <p class="text-3xl font-semibold text-green-600"><?= $status_counts['Selesai'] ?></p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-bold text-gray-200">Sedang Dikerjakan</h2>
          <p class="text-3xl font-semibold text-yellow-600"><?= $status_counts['Sedang Dikerjakan'] ?></p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h2 class="text-lg font-bold text-gray-200">Terlambat</h2>
          <p class="text-3xl font-semibold text-red-600"><?= $status_counts['Terlambat'] ?></p>
        </div>
      </section>

      <!-- Content Section -->
      <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Deadline Section -->
        <div class="bg-gray-700 p-6 rounded-lg">
          <h2 class="text-lg font-bold mb-4">Deadline Time</h2>
          <ul id="deadline-list">
            <?php 
            while ($row1 = mysqli_fetch_assoc($result_mata_kuliah))
              while ($row = mysqli_fetch_assoc($result_tugas)) : ?>
              <li class="flex items-center bg-white text-black p-2 mb-2 rounded">
                <input type="checkbox" class="mr-2" data-tugas-id="<?= $row['id_tugas'] ?>" onclick="toggleTask(this)" <?= $row['status'] === 'Selesai' ? 'checked' : '' ?>>
                <span class="<?= $row['status'] === 'Selesai' ? 'line-through text-gray-400' : '' ?>">
                <?= htmlspecialchars($row1['name']) ?> : <?= htmlspecialchars($row['name']) ?> 
                </span>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>

        <!-- Chart Section -->
        <div class="grid grid-cols-1 gap-6">
          <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
            <canvas id="lineChart"></canvas>
          </div>

          <div class="bg-gray-700 p-4 rounded-lg shadow-lg">
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </section>
    </div>
  </main>
  <?php include '../../utils/footer.php' ?>
</body>

</html>