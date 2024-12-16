<?php
include('../../koneksi.php');

// Tambah tugas
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "INSERT INTO tasks (name, reminder_time) VALUES ('$name', '$reminder_time')";
    $conn->query($sql);
    header("Location: ../../../WEB-PHP/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Tugas</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Form Tambah Tugas</h5>
                        <form method="POST">
                            <!-- Nama Tugas -->
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Nama Tugas:</label>
                                <input type="text" class="form-control" id="taskName" name="name" placeholder="Masukkan nama tugas" required>
                            </div>

                            <!-- Deskripsi Tugas -->
                            <div class="mb-3">
                                <label for="taskDescription" class="form-label">Deskripsi Tugas:</label>
                                <textarea class="form-control" id="taskDescription" name="description" rows="3" placeholder="Masukkan deskripsi tugas" required></textarea>
                            </div>

                            <!-- Waktu Pengingat -->
                            <div class="mb-3">
                                <label for="taskTime" class="form-label">Waktu Pengingat:</label>
                                <input type="datetime-local" class="form-control" id="taskTime" name="reminder_time" required>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary w-100" name="create">Tambah Tugas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>