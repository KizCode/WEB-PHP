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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../../style/profile.css">
</head>

<body>
  <div class="container">
    <div class="profile-card">
      <!-- Header -->
      <div class="header">
        <img src="../../assets/upload/<?php echo $user['gambar'] ?>" alt="Avatar" class="avatar">
        <div class="info">
          <h2><?php echo $user['username']; ?></h2>
          <p>D3 Sistem Informasi</p>
        </div>
        <div class="stats">
          <div>
            <h3>12</h3>
            <p>Followers</p>
          </div>
          <div>
            <h3>4</h3>
            <p>Messages</p>
          </div>
        </div>
      </div>

      <!-- Details Section -->
      <div class="details">
        <div class="detail-item">
          <span class="icon">📍</span>
          <p class="text">Bandung<br><span>Telkom University</span></p>
        </div>
        <div class="detail-item">
          <span class="icon">📅</span>
          <p class="text">Subject (4)</p>
        </div>
        <div class="detail-item">
          <span class="icon">📞</span>
          <p class="text">08123456789</p>
        </div>
        <a href="edit.php" class="edit-btn">Edit Profile</a>
      </div>

      <!-- Status Section -->
      <div class="status">
        <h3>Assignment Project Status</h3>
        <p>Task Finished: 4</p>
        <p>Late: 2</p>
        <p>On Going: 5</p>
      </div>

      <!-- Tombol Kembali ke Halaman Awal -->
      <div class="text-center mt-4 mb-4">
        <a href="../../index.php" class="btn btn-secondary">Kembali ke Halaman Awal</a>
        <a href="../../delete.php" class="btn btn-secondary">delete account</a></a>
      </div>
    </div>
  </div>
  <?php include('../../script.php'); ?>
</body>

</html>