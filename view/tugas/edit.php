<?php
include('../../koneksi.php');
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Cek jika ID tugas ada dalam parameter GET
if (isset($_GET['id'])) {
    $task_id = $_GET['id']; // Ambil ID tugas dari URL

    // Query untuk mengambil data tugas berdasarkan ID
    $sql = "SELECT * FROM tugas WHERE id_tugas = $task_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data tugas
        $taskToEdit = $result->fetch_assoc();
    } else {
        echo "Tugas tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tugas tidak ditemukan.";
    exit();
}

// Update tugas jika form disubmit
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $name = $_POST['name'];
    $reminder_time = $_POST['reminder_time'];

    // Update query dengan kolom yang benar
    $sql = "UPDATE tugas SET name = '$name', description = '$description', reminder_time = '$reminder_time' WHERE id_tugas = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=1"); // Redirect ke halaman utama setelah berhasil update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container mx-auto mt-10 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-xl">
                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6 scale-75 md:scale-100 lg:scale-125">
                    <div class="flex justify-between items-center mb-4">
                        <!-- Judul -->
                        <h5 class="text-center text-2xl font-semibold">Edit Tugas</h5>
                        <!-- Tombol X -->
                        <a href="index.php" class="text-white text-lg font-bold hover:text-gray-400 transition duration-200">
                            &times;
                        </a>
                    </div>


                    <!-- Form -->
                    <form method="POST">
                        <!-- ID (Hidden) -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($taskToEdit['id_tugas']) ?>">

                        <!-- Nama Tugas -->
                        <div class="mb-4">
                            <label for="taskName" class="block text-sm font-medium mb-2">Nama Tugas</label>
                            <input type="text" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" name="name" value="<?= htmlspecialchars($taskToEdit['name']) ?>" required>
                        </div>

                        <!-- Deskripsi Tugas -->
                        <div class="mb-4">
                            <label for="taskDescription" class="block text-sm font-medium mb-2">Deskripsi Tugas</label>
                            <textarea class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" name="description"><?= htmlspecialchars($taskToEdit['description']) ?></textarea>
                        </div>

                        <!-- Waktu Pengingat -->
                        <div class="mb-4">
                            <label for="taskTime" class="block text-sm font-medium mb-2">Waktu Pengingat</label>
                            <input type="datetime-local" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" name="reminder_time" value="<?= htmlspecialchars($taskToEdit['reminder_time']) ?>" required>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-between items-center space-x-2">
                            <button type="submit"
                                class="bg-yellow-500 w-full text-white py-1 px-3 rounded-lg hover:bg-yellow-600 transition duration-200"
                                name="update">
                                Perbarui Tugas
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>