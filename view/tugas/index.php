<!-- Ambil semua tugas -->
<?php
include('../../koneksi.php');
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