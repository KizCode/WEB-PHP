<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
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
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <!-- Navbar -->
  <div class="container">
    <?php include 'utils/navbar.php'; ?>

    <!-- Header -->
    <header>
      <h1 class="text-3xl font-bold">Hello, <?php echo $_SESSION['username']; ?></h1>
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