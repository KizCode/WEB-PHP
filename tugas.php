<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Reminder</title>
  <link rel="stylesheet" href="../WEB-PHP/style/tugas.css">
</head>
<body>
  <div class="container">
    <h1>Task Reminder</h1>
    <!-- Form Tambah Tugas -->
    <div class="add-task-form">
      <h2>Tambah Tugas</h2>
      <form id="taskForm">
        <div class="form-group">
          <label for="taskName">Nama Tugas:</label>
          <input type="text" id="taskName" placeholder="Masukkan nama tugas" required>
        </div>
        <div class="form-group">
          <label for="taskTime">Waktu Pengingat:</label>
          <input type="time" id="taskTime" required>
        </div>
        <button type="submit">Tambah Tugas</button>
      </form>
    </div>

    <!-- Daftar Tugas -->
    <div class="task-list">
      <h2>Daftar Tugas</h2>
      <ul id="tasks"></ul>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>
