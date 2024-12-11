<?php
include '../koneksi.php';

// Tambah tugas
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];



    $sql = "INSERT INTO users (name, email, username, password, role) VALUES ('$name', '$email', '$username', '$password', '$role')";
    $conn->query($sql);
    header("Location: index.php");
}

// Hapus tugas
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

// Ambil data untuk edit
$taskToEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $taskToEdit = $result->fetch_assoc();
}

// Update tugas
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role = $_POST['role_id'];

    $sql = "UPDATE users SET name='$name', email='$email', username='$username', role_id='$role_id,' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

// Ambil semua tugas
$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="">
</head>

<body>
    <div class="container">
        <h1>Daftar User</h1>
        <div class="card">
            <div class="card-body">

                <!-- Form Tambah/Edit Tugas -->
                <div class="add-task-form">
                    <h2><?= $taskToEdit ? 'Edit Tugas' : 'Tambah Tugas' ?></h2>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $taskToEdit['id'] ?? '' ?>">
                        <div class="form-group">
                            <label for="taskName">Nama Tugas:</label>
                            <input class="form-control" type="text" id="taskName" name="name" value="<?= $taskToEdit['name'] ?? '' ?>" placeholder="Masukkan nama user" required>
                        </div>
                        <div class="form-group">
                            <label for="taskTime">Email:</label>
                            <input class="form-control" type="email" id="taskTime" name="email" value="<?= $taskToEdit['email'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="taskTime">Username:</label>
                            <input class="form-control" type="name" id="taskTime" name="username" value="<?= $taskToEdit['username'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" id="role" name="role_id" required>
                                <?php
                                $roles = $conn->query("SELECT id, name FROM roles");
                                while ($role = $roles->fetch_assoc()) {
                                    echo "<option value='{$role['id']}'>{$role['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="<?= $taskToEdit ? 'update' : 'create' ?>">
                            <?= $taskToEdit ? 'Update Tugas' : 'Tambah Tugas' ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $roles = $conn->query("SELECT id, name FROM roles"); 
        $role = $roles->fetch_assoc();    
        ?>
        <!-- Daftar Tugas -->
        <div class="task-list">
            <h2>Daftar User</h2>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $role['name'] ?></td>
                            <td>
                                <a href="index.php?edit=<?= $task['id'] ?>">Edit</a>
                                <a href="index.php?delete=<?= $task['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>