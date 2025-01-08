<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); 
    exit();
  }

// Ambil data user dari database
include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id']; // Mengambil user_id dari sesi

    // Proses upload gambar (jika ada)
    $gambar = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../../assets/upload/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = basename($_FILES["gambar"]["name"]);
        }
    }

    // Insert data ke tabel utas
    $sql = "INSERT INTO utas (name, description, gambar, user_id) VALUES ('$name', '$description', '$gambar', '$user_id')";
    $conn->query($sql);

    // Redirect setelah berhasil
    header("Location: ./index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Diskusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white min-h-screen flex flex-col">
    <!-- Navbar -->
    <?php include '../../utils/navbar.php'; ?>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 flex-grow">
        <form method="POST" class="bg-gray-800 shadow-md rounded-lg p-6 max-w-2xl mx-auto relative">

            <!-- Judul Utas -->
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Utas</label>
            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>

            <!-- Deskripsi -->
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <textarea id="description" name="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required></textarea>

            <!-- Upload Gambar -->
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="gambar" accept=".jpg, .png, .jpeg">


            <!-- Tombol Submit -->
            <button type="submit" name="create" class="mt-5 px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Tambah Utas
            </button>

        </form>
    </main>


    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>

</html>