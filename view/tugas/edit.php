<?php
include('../../koneksi.php');

// Edit tugas
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "UPDATE tasks SET name = '$name', reminder_time = '$reminder_time' WHERE id = $id";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

// Ambil data untuk di-edit
$taskToEdit = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tasks WHERE id = $id");
    $taskToEdit = $result->fetch_assoc();
    if (!$taskToEdit) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Tugas</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Form Edit Tugas</h5>
                        <form method="POST">
                            <!-- ID (Hidden) -->
                            <input type="hidden" name="id" value="<?= htmlspecialchars($taskToEdit['id']) ?>">

                            <!-- Nama Tugas -->
                            <div class="mb-3">
                                <label for="taskName" class="form-label">Nama Tugas:</label>
                                <input type="text" class="form-control" id="taskName" name="name" value="<?= htmlspecialchars($taskToEdit['name']) ?>" required>
                            </div>

                            <!-- Waktu Pengingat -->
                            <div class="mb-3">
                                <label for="taskTime" class="form-label">Waktu Pengingat:</label>
                                <input type="time" class="form-control" id="taskTime" name="reminder_time" value="<?= htmlspecialchars($taskToEdit['reminder_time']) ?>" required>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary w-100" name="update">Perbarui Tugas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
