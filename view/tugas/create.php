<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Tambah tugas
include('../../koneksi.php');
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $reminder_time = $_POST['reminder_time'];
    $user_id = $_SESSION['user_id']; 

    $sql = "INSERT INTO tugas (name, description, reminder_time, user_id) VALUES ('$name', '$description', '$reminder_time', '$user_id')";
    $conn->query($sql);
    header("Location: ../tugas/index.php");
    exit();
}


?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container mx-auto mt-10 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-xl">
                <div class="bg-gray-800 text-white text-gray-800 rounded-lg shadow-lg p-6 scale-75 md:scale-100 lg:scale-125">
                    <!-- Tombol X -->
                    <div class="flex justify-end mb-4">
                        <a href="index.php" class="text-white text-lg font-bold hover:text-gray-400 transition duration-200">
                            &times;
                        </a>
                    </div>
                    
                    <!-- Judul -->
                    <h5 class="text-center text-2xl font-semibold mb-4">Tambah Tugas</h5>
                    
                    <!-- Form -->
                    <form method="POST">
                        <!-- Nama Tugas -->
                        <div class="mb-4">
                            <label for="taskName" class="block text-sm font-medium mb-2">Nama Tugas:</label>
                            <input type="text" id="taskName" name="name" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Masukkan nama tugas" required>
                        </div>

                        <!-- Deskripsi Tugas -->
                        <div class="mb-4">
                            <label for="taskDescription" class="block text-sm font-medium mb-2">Deskripsi Tugas:</label>
                            <textarea id="taskDescription" name="description" rows="3" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Masukkan deskripsi tugas" required></textarea>
                        </div>

                        <!-- Waktu Pengingat -->
                        <div class="mb-4">
                            <label for="taskTime" class="block text-sm font-medium mb-2">Waktu Pengingat:</label>
                            <input type="datetime-local" id="taskTime" name="reminder_time" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200" name="create">Tambah Tugas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
