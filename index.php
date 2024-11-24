<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
  header("Location: login.php"); // Redirect ke login jika belum login
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <div class="container">
    <!-- Navbar -->
    <nav class="navbar">
      <ul>
        <li><a href="#">Upload</a></li>
        <li><a href="#">Discuss</a></li>
        <li><a href="#">Video</a></li>
      </ul>
      <!-- Profile Section -->
      <a href="profile.html" class="profile-link">
        <div class="profile">
          <img src="e4f77377b9c1a7cd8258210097d9f633.jpg" alt="Profile Icon">
          <span><?php echo $_SESSION['user']; ?></span>
        </div>
      </a>
    </nav>

    <!-- Header -->
    <header>
      <h1 class="text-3xl font-bold">Hello, <?php echo $_SESSION['user']; ?></h1>
    </header>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Deadlines -->
      <section class="deadlines">
        <h2>DEADLINE TIME!!!</h2>
        <div class="deadline">
          <h3>Friday, 26 April 2024</h3>
          <ul>
            <li><input type="checkbox"> Basis Data: Tugas 2, Assesment 3</li>
            <li><input type="checkbox"> IUXD: Project kelompok</li>
            <li><input type="checkbox"> Alpro: PR Praktikum 3</li>
          </ul>
        </div>
        <div class="deadline">
          <h3>Saturday, 27 April 2024</h3>
          <ul>
            <li><input type="checkbox"> Matdis: Latihan soal 2</li>
          </ul>
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
          <div class="progress-bar">
            <div class="not-finished">Not Finished Yet</div>
            <div class="finished">Finished</div>
            <div class="late">Late (2)</div>
          </div>
          <p>Alpro Udin's</p>
        </section>
      </div>
    </div>
  </div>
</body>

</html>