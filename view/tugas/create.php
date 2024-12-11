<?php
include('../../koneksi.php');

// Tambah tugas
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "INSERT INTO tasks (name, reminder_time) VALUES ('$name', '$reminder_time')";
    $conn->query($sql);
    header("Location: tugas.php");
}
?>

<!-- Form Tambah/Edit Tugas -->
<div class="add-task-form">
    <h2>Tambah Tuags</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $taskToEdit['id'] ?? '' ?>">
        <div class="form-group">
            <label for="taskName">Nama User:</label>
            <input type="text" id="taskName" name="name" value="<?= $taskToEdit['name'] ?? '' ?>" placeholder="Masukkan nama tugas" required>
        </div>
        <div class="form-group">
            <label for="taskTime">Waktu Pengingat:</label>
            <input type="time" id="taskTime" name="reminder_time" value="<?= $taskToEdit['reminder_time'] ?? '' ?>" required>
        </div>
        <button type="submit" name="<?= $taskToEdit ? 'update' : 'create' ?>">

        </button>
    </form>
</div>