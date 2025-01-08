<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); 
    exit();
  }

include('../../koneksi.php');

// Ambil data mata kuliah berdasarkan ID
if (isset($_GET['id'])) {
    $id_mata_kuliah = $_GET['id'];

    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM mata_kuliah WHERE id_mata_kuliah = ? AND user_id = ?");
    $stmt->bind_param("ii", $id_mata_kuliah, $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $mata_kuliah = $result->fetch_assoc();
    $stmt->close();

    if (!$mata_kuliah) {
        echo "Mata kuliah tidak ditemukan atau Anda tidak memiliki izin untuk mengaksesnya.";
        exit();
    }
} else {
    header("Location: ../tugas/index.php"); // Redirect jika tidak ada ID
    exit();
}

// Update data mata kuliah
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $description = $_POST['description'];

    // Update data di database
    $stmt = $conn->prepare("UPDATE mata_kuliah SET name = ?, code = ?, description = ? WHERE id_mata_kuliah = ? AND user_id = ?");
    $stmt->bind_param("sssii", $name, $code, $description, $id_mata_kuliah, $_SESSION['user_id']);
    if ($stmt->execute()) {
        header("Location: ../tugas/index.php?message=updated"); // Redirect dengan pesan sukses
        exit();
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container mx-auto mt-10 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-xl">
                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-6">
                    <!-- Judul -->
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-center text-2xl font-semibold">Edit Mata Kuliah</h5>
                        <a href="index.php" class="text-white text-lg font-bold hover:text-gray-400 transition duration-200">
                            &times;
                        </a>
                    </div>
                    <!-- Form -->
                    <form method="POST">
                        <!-- Nama Mata Kuliah -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium mb-2">Nama Mata Kuliah:</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($mata_kuliah['name']) ?>" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                        </div>
                        
                        <!-- Kode Mata Kuliah -->
                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium mb-2">Kode Mata Kuliah:</label>
                            <input type="text" id="code" name="code" value="<?= htmlspecialchars($mata_kuliah['code']) ?>" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                        </div>
                        
                        <!-- Deskripsi Mata Kuliah -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium mb-2">Deskripsi Mata Kuliah:</label>
                            <textarea id="description" name="description" rows="3" class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none"><?= htmlspecialchars($mata_kuliah['description']) ?></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200" name="update">Perbarui Mata Kuliah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
