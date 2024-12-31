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
    <title>Forum Diskusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="mx-auto bg-gray-800 min-h-screen text-white flex flex-col ">
    <!-- Main Content -->
    <main class="mb-auto">
        <?php include '../../utils/sidebar.php'; ?>
        <div class="container mx-auto my-auto mb-20">

            <h1 class="text-3xl uppercase font-bold mb-4">Forum Diskusi</h1>
            <!-- Breadcrumb -->
            <div class="mb-4 text-sm text-gray-100">
                <a href="#" class="hover:text-blue-500">Diskusi</a>
                <span class="mx-2">/</span>
                <span>Beranda</span>
            </div>

            <!-- Featured Question -->
            <section class="bg-gray-900 shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-2">Pertanyaan Unggulan</h2>
                <div class="border-t pt-4">
                    <div class="flex items-start space-x-4">
                        <img src="https://via.placeholder.com/50" alt="User Avatar" class="w-12 h-12 rounded-full">
                        <div>
                            <a href="reply.php" class="text-lg font-bold hover:text-blue-600">Bagaimana cara meningkatkan performa aplikasi?</a>
                            <p class="text-sm text-gray-100 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium">Aulia Rahman</span> pada 20 Desember 2023</p>
                            <div class="mt-2 flex space-x-4 text-gray-600">
                                <span class="flex items-center space-x-1">
                                    <span>👁️</span>
                                    <span>120</span>
                                </span>
                                <span class="flex items-center space-x-1">
                                    <span>💬</span>
                                    <span>35</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Questions List -->
            <section>
                <h2 class="text-xl font-semibold mb-4">Diskusi Terbaru</h2>
                <div class="space-y-4">
                    <!-- Question Item -->
                    <div class="bg-gray-900 shadow-md rounded-lg p-4">
                        <div class="flex items-start space-x-4">
                            <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-100 hover:text-blue-600 transition">
                                    Apa perbedaan antara Tailwind CSS dan Bootstrap?
                                </h3>
                                <p class="text-sm text-gray-100 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium">Dimas Arya</span> pada 15 Desember 2023</p>
                            </div>
                            <div class="text-right text-gray-600 space-y-1">
                                <span class="block">👁️ 98</span>
                                <span class="block">💬 12</span>
                            </div>
                        </div>
                    </div>

                    <!-- Another Question Item -->
                    <div class="bg-gray-900 shadow-md rounded-lg p-4">
                        <div class="flex items-start space-x-4">
                            <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-100 hover:text-blue-600 transition">
                                    Bagaimana cara debugging di JavaScript secara efisien?
                                </h3>
                                <p class="text-sm text-gray-100 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium">Rahma Dewi</span> pada 14 Desember 2023</p>
                            </div>
                            <div class="text-right text-gray-600 space-y-1">
                                <span class="block">👁️ 75</span>
                                <span class="block">💬 9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>

</html>