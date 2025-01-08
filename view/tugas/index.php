<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); // Redirect ke login jika belum login
    exit();
}

include('../../koneksi.php');
$user_id = $_SESSION['user_id'];

// Ambil data user
$query_user = "SELECT * FROM user WHERE id_user = $user_id";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_assoc($result_user);

// Ambil data mata kuliah
$query_mata_kuliah = "SELECT * FROM mata_kuliah WHERE user_id = $user_id";
$result_mata_kuliah = mysqli_query($conn, $query_mata_kuliah);

// Ambil data tugas
$query_tugas = "SELECT * FROM tugas WHERE user_id = $user_id";
$result_tugas = mysqli_query($conn, $query_tugas);
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
</head>

<body class="mx-auto bg-[color:var(--main-color)] min-h-screen text-white flex flex-col relative">
    <main class="mb-auto">
        <?php include '../../utils/navbar.php'; ?>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl uppercase font-bold mb-6 text-start">Daftar Tugas</h1>

            <!-- Mata Kuliah Section -->
            <section class="bg-gray-900 p-4 sm:p-6 rounded-lg mb-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg sm:text-xl font-semibold uppercase">Mata Kuliah</h2>
                    <a href="../matakuliah/create.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-bold">Tambah Data</a>
                </div>
                <div class="mt-4 overflow-x-auto">
                    <table class="table-auto w-full text-left border-collapse border border-gray-700">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="px-4 py-2 border border-gray-600">No</th>
                                <th class="px-4 py-2 border border-gray-600">Subject</th>
                                <th class="px-4 py-2 border border-gray-600">Kode</th>
                                <th class="px-4 py-2 border border-gray-600">Deskripsi</th>
                                <th class="px-4 py-2 border border-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($row = mysqli_fetch_assoc($result_mata_kuliah)) { ?>
                                <tr>
                                    <td class="px-4 py-2 border border-gray-600"><?= $i++ ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= htmlspecialchars($row['code']) ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= htmlspecialchars($row['description']) ?></td>
                                    <td class="px-4 py-2 border border-gray-600 w-[200px]">
                                        <div class="flex justify-around">
                                            <!-- Tombol Edit -->
                                            <a href="../matakuliah/edit.php?id=<?= $row['id_mata_kuliah'] ?>" class="bg-yellow-500 text-white py-1 px-4 rounded-lg hover:bg-yellow-700 font-bold">Edit</a>

                                            <!-- Tombol Delete -->
                                            <form action="../matakuliah/delete.php" method="POST" class="inline" id="deleteForm-<?= $row['id_mata_kuliah'] ?>">
                                                <input type="hidden" name="id" value="<?= $row['id_mata_kuliah'] ?>">
                                                <button type="button" class="bg-red-500 text-white py-1 px-2 rounded-lg hover:bg-red-700 font-bold" onclick="confirmDelete(<?= $row['id_mata_kuliah'] ?>)">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                        <script>
                            // Fungsi konfirmasi untuk hapus
                            function confirmDelete(id) {
                                if (confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')) {
                                    document.getElementById('deleteForm-' + id).submit();
                                }
                            }
                        </script>

                    </table>
                </div>
            </section>

            <!-- Tugas Section -->
            <section class="bg-gray-900 p-4 sm:p-6 rounded-lg mb-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg sm:text-xl font-semibold uppercase">Daftar Tugas</h2>
                    <a href="../tugas/create.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-bold">Tambah Data</a>
                </div>

                <div class="mt-4 overflow-x-auto">
                    <table class="table-auto w-full text-left border-collapse border border-gray-700 text-sm sm:text-base">
                        <thead>
                            <tr class="bg-gray-700">
                                <th class="px-4 py-2 border border-gray-600 w-7">No</th>
                                <th class="px-4 py-2 border border-gray-600">Judul</th>
                                <th class="px-4 py-2 border border-gray-600">Deskripsi</th>
                                <th class="px-4 py-2 border border-gray-600">Status</th>
                                <th class="px-4 py-2 border border-gray-600 w-[150px]">Deadline</th>
                                <th class="px-4 py-2 border border-gray-600 w-[150px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            while ($row = mysqli_fetch_assoc($result_tugas)) { ?>
                                <tr class="bg-gray-800">
                                    <td class="px-4 py-2 border border-gray-600"><?= $i++ ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['name'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['description'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600"><?= $row['status'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600 w-[200px]"><?= $row['reminder_time'] ?></td>
                                    <td class="px-4 py-2 border border-gray-600 w-[200px]">
                                        <div class="flex justify-around">
                                            <!-- Tombol Edit -->
                                            <a href="../tugas/edit.php?id=<?= $row['id_tugas'] ?>" class="bg-yellow-500 text-white py-1 px-4 rounded-lg hover:bg-yellow-700 font-bold">Edit</a>

                                            <!-- Tombol Delete -->
                                            <form action="delete.php" method="POST" class="inline" id="deleteForm-<?= $row['id_tugas'] ?>">
                                                <input type="hidden" name="id" value="<?= $row['id_tugas'] ?>">
                                                <button type="button" class="bg-red-500 text-white py-1 px-2 rounded-lg hover:bg-red-700 font-bold" onclick="confirmDelete(<?= $row['id_tugas'] ?>)">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </div>
    </main>

    <?php include '../../utils/footer.php'; ?>
</body>

</html>