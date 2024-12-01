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
          <a class="btn btn-primary" href="../WEB-PHP/tugas.php">Tambah Tugas</a>
          <div class="progress-bar">
            <div class="not-finished">Not Finished Yet</div>
            <div class="finished">Finished</div>
            <div class="late">Late (2)</div>
          </div>
        </section>
      </div>
    </div>
  </div>
  <?php include 'script.php' ?>
</body>

</html>