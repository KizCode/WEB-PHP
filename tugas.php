<?php
include '../WEB-PHP/koneksi.php';

// Tambah tugas
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "INSERT INTO tasks (name, reminder_time) VALUES ('$name', '$reminder_time')";
    $conn->query($sql);
    header("Location: tugas.php");
}

// Hapus tugas
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
    header("Location: tugas.php");
}

// Ambil data untuk edit
$taskToEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM tasks WHERE id=$id");
    $taskToEdit = $result->fetch_assoc();
}

// Update tugas
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    $sql = "UPDATE tasks SET name='$name', reminder_time='$reminder_time' WHERE id=$id";
    $conn->query($sql);
    header("Location: tugas.php");
}

// Ambil semua tugas
$tasks = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
    <link rel="stylesheet" href="tugas.css">
</head>
<body>
<div class="container">
    <h1>Task Reminder</h1>


    <!-- Daftar Tugas -->
    <div class="task-list">
        <h2>Daftar Tugas</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama Tugas</th>
                <th>Waktu Pengingat</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($task = $tasks->fetch_assoc()): ?>
                <tr>
                    <td><?= $task['id'] ?></td>
                    <td><?= $task['name'] ?></td>
                    <td><?= $task['reminder_time'] ?></td>
                    <td>
                        <a href="tugas.php?edit=<?= $task['id'] ?>">Edit</a>
                        <a href="tugas.php?delete=<?= $task['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>