<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); 
    exit();
}

// Tambah tugas
include('../../koneksi.php');

if (isset($_POST['create'])) {
    // Ambil data dari form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $reminder_time = $_POST['reminder_time'];
    $user_id = $_SESSION['user_id'];
    $mata_kuliah_id = $_POST['mata_kuliah_id']; // Mengambil mata kuliah ID yang dipilih

    // Gunakan prepared statements untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO tugas (name, description, reminder_time, user_id, mata_kuliah_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $description, $reminder_time, $user_id, $mata_kuliah_id);
    if ($stmt->execute()) {
        // Redirect ke halaman tugas setelah berhasil menambah
        header("Location: ../tugas/index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Query untuk mengambil mata kuliah
$sql_mata_kuliah = "SELECT id_mata_kuliah, name FROM mata_kuliah";
$result = mysqli_query($conn, $sql_mata_kuliah);

if (!$result) {
    die("Error fetching mata kuliah: " . mysqli_error($conn));
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
                    <!-- Judul -->
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-center text-2xl font-semibold">Tambah Tugas</h5>
                        <a href="index.php" class="text-white text-lg font-bold hover:text-gray-400 transition duration-200">&times;</a>
                    </div>
                    <!-- Form -->
                    <form method="POST">
                        <!-- Pilih Mata Kuliah -->
                        <label for="mataKuliah" class="block text-sm font-medium mb-2">Pilih Mata Kuliah Tugas:</label>
                        <select name="mata_kuliah_id" id="mataKuliah" class="mb-2 form-select w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none>" required>
                            <?php
                            // Loop through mata kuliah data dan buat opsi
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id_mata_kuliah'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>

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
