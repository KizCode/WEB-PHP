<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}

// Ambil data user dari database
include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi Balasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-800 w-full text-gray-200 flex">

    <!-- Main Content -->
    <main class="flex-1 mx-auto">
        <?php include '../../utils/sidebar.php'; ?>
        <div class="container mx-auto my-auto">
            <h1 class="text-3xl uppercase font-bold mb-4">Forum Diskusi</h1>
            <!-- Breadcrumb -->
            <div class="mb-4 text-sm text-gray-100">
                <a href="#" class="hover:text-blue-500">Beranda</a>
                <span class="mx-2">/</span>
                <span>Diskusi</span>
            </div>
            <!-- Detail Question -->
            <section class="bg-gray-900 shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-200">Bagaimana cara meningkatkan performa aplikasi?</h2>
                <p class="text-sm text-gray-100 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium">Aulia Rahman</span> pada 20 Desember 2023</p>
                <div class="mt-4">
                    <p>
                        Saya sedang mengembangkan aplikasi berbasis web, namun performanya lambat pada pengguna tertentu. Bagaimana cara yang efisien untuk meningkatkan performa dan memastikan pengalaman pengguna yang lebih baik?
                    </p>
                </div>
                <div class="mt-4 flex space-x-4 text-gray-200">
                    <span class="flex items-center space-x-1">
                        <span>👁️</span>
                        <span>120</span>
                    </span>
                    <span class="flex items-center space-x-1">
                        <span>💬</span>
                        <span>35</span>
                    </span>
                </div>
            </section>

            <!-- Replies Section -->
            <section>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Balasan</h3>
                <div class="space-y-4">
                    <!-- Reply Item -->
                    <div class="bg-gray-900 shadow-md rounded-lg p-4">
                        <div class="flex items-start space-x-4">
                            <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <p class="text-gray-200">
                                    <span class="font-bold">Dimas Arya</span>
                                    <span class="text-sm text-gray-200"> - 21 Desember 2023</span>
                                </p>
                                <p class="mt-2">
                                    Salah satu cara terbaik adalah dengan memanfaatkan caching. Gunakan CDN untuk mempercepat pengiriman data statis ke pengguna di berbagai lokasi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Another Reply Item -->
                    <div class="bg-gray-900 shadow-md rounded-lg p-4">
                        <div class="flex items-start space-x-4">
                            <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <p class="text-gray-200">
                                    <span class="font-bold">Rahma Dewi</span>
                                    <span class="text-sm text-gray-200"> - 21 Desember 2023</span>
                                </p>
                                <p class="mt-2">
                                    Selain itu, pastikan database Anda dioptimalkan. Index tabel dan hindari query yang kompleks atau tidak diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Reply Form -->
            <section class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Balasan</h3>
                <form action="#" method="POST" class="bg-gray-900 shadow-md rounded-lg p-4">
                    <div class="mb-4">
                        <label for="reply" class="block text-sm font-bold text-gray-200 mb-2">Balasan Anda:</label>
                        <textarea id="reply" name="reply" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tulis balasan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
                        Kirim Balasan
                    </button>
                </form>
            </section>
    </main>
    </div>
    

</body>

</html>