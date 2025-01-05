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

// Menulis query untuk mengambil data tugas
$sql = "SELECT * FROM tugas WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Styling khusus untuk DataTables */
        .dataTables_wrapper .dataTables_length select {
            background-color: #1f2937;
            color: #ffffff;
            border: 1px solid #374151;
            border-radius: 0.375rem;
            padding: 0.375rem 0.5rem;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_length select:focus {
            outline: none;
        }
    </style>
</head>

<body class="mx-auto bg-[color:var(--main-color)] min-h-screen text-white flex flex-col relative">
    <!-- Main Content -->
    <main class="mb-auto">
        <?php include '../../utils/navbar.php'; ?>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl uppercase font-bold mb-6 text-start">Daftar Tugas</h1>
            <!-- Breadcrumb -->
            <div class="mb-4 text-sm text-gray-100 flex flex-wrap items-center">
                <a href="#" class="hover:text-blue-500">Tugas</a>
                <span class="mx-2 flex items-center">
                    /
                    <svg class="ml-2 w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z" />
                    </svg>
                </span>
            </div>
            <!-- Tabel Tugas -->
            <section class="bg-gray-900 p-4 sm:p-6 rounded-lg mb-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg sm:text-xl font-semibold uppercase">Deadline Time</h2>
                    <a href="../tugas/create.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 hover:scale-105 transition-transform duration-300 font-bold">Tambah Data</a>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table id="Table1" class="table-auto w-full text-left border-collapse border border-gray-700 text-sm sm:text-base">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="px-4 py-2 border border-gray-600 w-7">No</th>
                                <th class="px-4 py-2 border border-gray-600">Judul</th>
                                <th class="px-4 py-2 border border-gray-600">Deskripsi</th>
                                <th class="px-4 py-2 border border-gray-600 w-[150px]">Deadline</th>
                                <th class="px-4 py-2 border border-gray-600 w-[150px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr class="bg-gray-800">
                                    <td class="px-4 py-2 border border-gray-600"><?= $i++ ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['name'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['description'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['reminder_time'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600 w-[200px]">
                                        <div class="flex justify-around">
                                            <!-- Tombol Edit -->
                                            <a href="../tugas/edit.php?id=<?= $row['id_tugas'] ?>" class="bg-yellow-500 text-white py-2 px-3 rounded-lg hover:bg-yellow-700 hover:scale-105 transition-transform duration-300 font-bold">
                                                Edit
                                            </a>
                                            <!-- Tombol Delete -->
                                            <form action="delete.php" method="POST" class="inline" id="deleteForm-<?= $row['id_tugas'] ?>">
                                                <input type="hidden" name="id" value="<?= $row['id_tugas'] ?>">
                                                <button type="button" class="bg-red-500 text-white py-2 px-3 rounded-lg hover:bg-red-700 hover:scale-105 transition-transform duration-300 font-bold" onclick="confirmDelete(<?= $row['id_tugas'] ?>)">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Tabel Mata Kuliah -->
            <section class="bg-gray-900 p-4 sm:p-6 rounded-lg">
                <h2 class="text-lg sm:text-xl font-semibold uppercase">Mata Kuliah</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="table-auto w-full text-left border-collapse border border-gray-700">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="px-4 py-2 border border-gray-600">Subject</th>
                                <th class="px-4 py-2 border border-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 border border-gray-600">Matdis</td>
                                <td class="px-4 py-2 border border-gray-600">
                                    <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs font-bold">Active</span>
                                </td>
                            </tr>
                            <tr class="bg-gray-800">
                                <td class="px-4 py-2 border border-gray-600">Basis Data</td>
                                <td class="px-4 py-2 border border-gray-600">
                                    <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs font-bold">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border border-gray-600">Alpro</td>
                                <td class="px-4 py-2 border border-gray-600">
                                    <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs font-bold">Active</span>
                                </td>
                            </tr>
                            <tr class="bg-gray-800">
                                <td class="px-4 py-2 border border-gray-600">IUXD</td>
                                <td class="px-4 py-2 border border-gray-600">
                                    <span class="bg-green-500 text-white py-1 px-2 rounded-full text-xs font-bold">Active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>

</html>