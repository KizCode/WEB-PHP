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
  <link rel="stylesheet" href="style/styles.css">
</head>

<body>
  <div class="container">
    <div class="profile-card">
      <!-- Header -->
      <div class="header">
        <img src="../assets/img/default.png" alt="Avatar" class="avatar">
        <div class="info">
          <h2>Udin Jamaludin</h2>
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
        <button class="edit-btn">Edit Profile</button>
      </div>

      <!-- Status Section -->
      <div class="status">
        <h3>Assignment Project Status</h3>
        <p>Task Finished: 4</p>
        <p>Late: 2</p>
        <p>On Going: 5</p>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <?php include 'script.php'; ?>
</body>

</html>