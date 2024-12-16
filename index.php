<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect ke login jika belum login
  exit();
}

// Ambil data user dari database
include('../WEB-PHP/koneksi.php');
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <!-- Navbar -->
  <div class="container">
    <?php include 'utils/navbar.php'; ?>

    <!-- Header -->
    <header>
      <h1 class="text-3xl font-bold">Hello, <?php echo $user['username']; ?></h1>
    </header>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Deadlines -->
      <section class="deadlines">

        <h2 class="text-uppercase">Deadlin Time</h2>
        <div class="deadline">
          <h2>Friday, 26 April 2024</h2>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Default checkbox
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Default checkbox
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Default checkbox
            </label>
          </div>
        </div>
        <div class="deadline">
          <h2>Saturday, 27 April 2024</h2>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Default checkbox
            </label>
          </div>
        </div>
      </section>

      <!-- Subjects and Current Project -->
      <div class="subjects-and-project">
        <section class="subjects">
          <h2>My Subject</h2>
          <div class="subject-grid">
            <div class="subject">Matdis</div>
            <div class="subject">Basis Data</div>
            <div class="subject">Alpro</div>
            <div class="subject">IUXD</div>
          </div>
        </section>


        <section class="current-project">
          <h2>Current Project</h2>
          <div class="progress-bar" id="bar">
            <button class="not-finished">Not Finished Yet</button>
            <button class="finished">Finished</button>
            <button class="late">Late (2)</button>
          </div>
          <div class="tugas">
            <table border="1">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Tugas</th>
                  <th>Deskripsi</th>
                  <th>Waktu Pengingat</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Mengecek apakah ada hasil
                if ($result->num_rows > 0) {
                  // Output data untuk setiap baris
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["reminder_time"] . "</td>";

                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </section>

      </div>
    </div>
  </div>
  <?php include 'script.php' ?>
</body>

</html>