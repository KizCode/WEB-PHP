<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>

<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect ke login jika belum login
    exit();
}
?>

<body class="flex justify-center bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <!-- <?php include('sidebar.php'); ?> -->

    <!-- Konten Utama -->
    <div class="flex-1 p-10 space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between ml-3">
            <h1 class="text-3xl font-bold">Hello, <?php echo $_SESSION['user']; ?></h1>
            <div class="bg-white p-3 rounded-full shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A10.97 10.97 0 0112 15c3.93 0 7.26 2.264 9.121 5.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>

        <!-- Grid untuk Deadline dan Current Project -->
        <div class="flex grid lg:grid-cols-6 grid-rows-auto lg:grid-rows-1 gap-3 m-6">
            <!-- Deadlines -->
            <div class="col-span-4 lg:col-span-2 row-span-auto bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
                <h2 class="text-xl font-semibold text-white">Deadline Time!!!</h2>
                <div class="space-y-3 text-white">
                    <div class="bg-gray-500 p-4 rounded-md">
                        <p class="font-bold">Friday, 26 April 2024</p>
                        <ul class="list-disc ml-5 text-sm">
                            <li>Basis Data: Tugas 2, Assessment 3</li>
                            <li>IXXD: Project Kelompok</li>
                        </ul>
                    </div>
                    <div class="bg-gray-500 p-4 rounded-md">
                        <p class="font-bold">Saturday, 27 April 2024</p>
                        <ul class="list-disc ml-5 text-sm">
                            <li>Matdis: Latihan Soal 2</li>
                        </ul>
                    </div>
                    <div class="bg-gray-500 p-4 rounded-md">
                        <p class="font-bold">Saturday, 27 April 2024</p>
                        <ul class="list-disc ml-5 text-sm">
                            <li>Matdis: Latihan Soal 2</li>
                        </ul>
                    </div>
                    <div class="bg-gray-500 p-4 rounded-md">
                        <p class="font-bold">Saturday, 27 April 2024</p>
                        <ul class="list-disc ml-5 text-sm">
                            <li>Matdis: Latihan Soal 2</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="grid grid-rows-2 col-span-4 gap-4">
                <!-- My Subject -->
                <div class="col-span-6 row-span-auto bg-purple-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 text-white">My Subject</h2>
                    <div class="flex gap-4">
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md flex items-center justify-center">
                            <span class="text-2xl">📐</span>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md flex items-center justify-center">
                            <span class="text-2xl">📖</span>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md flex items-center justify-center">
                            <span class="text-2xl">📘</span>
                        </div>
                        <div class="bg-gray-700 p-6 rounded-lg shadow-md flex items-center justify-center">
                            <span class="text-2xl">💻</span>
                        </div>
                    </div>
                </div>
                <!-- Current Projects -->
                <div class="col-span-6 row-span-auto bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-white mb-4">Current Project</h2>
                    <div class="flex justify-between mb-4">
                        <button class="text-white border-b-2 border-white pb-1">Not Finished Yet</button>
                        <button class="text-gray-400">Finished</button>
                        <button class="text-gray-400">Late (2)</button>
                    </div>
                    <div class="text-white">
                        <p>Alpro Udin's</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>