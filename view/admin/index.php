<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php"); // Redirect ke login jika belum login
    exit();
}

// Ambil data user dari database
include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Periksa apakah user memiliki role admin
if ($user['role_id'] !== '1') {
    // Jika bukan admin, alihkan ke halaman sebelumnya atau fallback ke halaman utama
    $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../dashboard/index.php';
    header("Location: " . $redirectUrl); // Redirect ke halaman sebelumnya atau utama
    exit();
}


// Query untuk mengambil total jumlah user
$query_total_users = "SELECT COUNT(*) AS total_users FROM user";
$result_total_users = mysqli_query($conn, $query_total_users);
$row_total_users = mysqli_fetch_assoc($result_total_users);
$total_users = $row_total_users['total_users'];

// Query untuk mengambil semua data user
$query_all_users = "SELECT * FROM user";
$result_all_users = mysqli_query($conn, $query_all_users);

// Fungsi untuk mendapatkan nama role berdasarkan role_id
function getRoleById($conn, $role_id)
{
    $query_role = "SELECT name FROM role WHERE id_role = $role_id";
    $result_role = mysqli_query($conn, $query_role);
    return mysqli_fetch_assoc($result_role);
}

// Menulis query untuk mengambil data tugas
$sql = "SELECT * FROM tugas";

// Menjalankan query
$result = $conn->query($sql);

// Mengecek apakah query berhasil dijalankan
if ($result) {
  $total_tugas = $result->num_rows; // Total tugas
} else {
  $total_tugas = 0; // Jika query gagal, set jumlah menjadi 0
}

// Menulis query untuk mengambil data tugas
$sql = "SELECT * FROM mata_kuliah";

// Menjalankan query
$result = $conn->query($sql);

// Mengecek apakah query berhasil dijalankan
if ($result) {
  $total_mata_kuliah = $result->num_rows; // Total tugas
} else {
  $total_mata_kuliah = 0; // Jika query gagal, set jumlah menjadi 0
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 text-white">
    <?php include('../../utils/navbar.php'); ?>

    <div class="container mx-auto px-4 py-8">
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <div class="bg-gray-700 p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-200">Total User</h2>
                <p class="text-4xl font-bold text-red-500"><?= $total_users ?></p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-200">Total Tugas</h2>
                <p class="text-4xl font-bold text-yellow-500"><?= $total_tugas ?></p>
            </div>
            <div class="bg-gray-700 p-6 rounded-lg shadow">
                <h2 class="text-lg font-bold text-gray-200">Total Mata Kuliah</h2>
                <p class="text-4xl font-bold text-green-500"><?= $total_mata_kuliah ?></p>
            </div>
        </section>

        <!-- Daftar User -->
        <section class="relative bg-gray-900 p-6 rounded-lg mb-6">
            <!-- Persegi belakang -->
            <div class="absolute top-0 left-0 w-full h-full bg-blue-900 opacity-50 rounded-lg -z-10"></div>

            <h1 class="text-3xl uppercase font-bold mb-6 text-start">Daftar User</h1>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg sm:text-xl font-semibold uppercase">DAFTAR USER</h2>
                <a href="../matakuliah/create.php" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-800 font-bold">Tambah Data</a>
            </div>
            <div class="overflow-x-auto bg-gray-800 p-4 rounded-lg shadow-lg">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-900 text-white">
                            <th class="px-6 py-3 border border-gray-700">No</th>
                            <th class="px-6 py-3 border border-gray-700">Nama</th>
                            <th class="px-6 py-3 border border-gray-700">Email</th>
                            <th class="px-6 py-3 border border-gray-700">Username</th>
                            <th class="px-6 py-3 border border-gray-700">Role</th>
                            <th class="px-6 py-3 border border-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($user = mysqli_fetch_assoc($result_all_users)) { ?>
                            <tr class="bg-gray-700 text-center hover:bg-gray-600">
                                <td class="px-6 py-3 border border-gray-600"><?= $i++ ?></td>
                                <td class="px-6 py-3 border border-gray-600"><?= ($user['name']) ?></td>
                                <td class="px-6 py-3 border border-gray-600"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-6 py-3 border border-gray-600"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="px-6 py-3 border border-gray-600">
                                    <?php
                                    $role = getRoleById($conn, $user['role_id']);
                                    echo htmlspecialchars($role['name']);
                                    ?>
                                </td>
                                <td class="px-6 py-3 border border-gray-600">
                                    <div class="flex justify-around">
                                        <!-- Tombol Edit -->
                                        <a href="edit.php?edit=<?= $user['id_user'] ?>" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-700 font-bold">Edit</a>
                                        <!-- Tombol Delete -->
                                        <form action="delete_user.php" method="POST" id="deleteForm-<?= $user['id_user'] ?>" class="inline">
                                            <input type="hidden" name="id" value="<?= $user['id_user'] ?>">
                                            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700 font-bold" onclick="confirmDelete(<?= $user['id_user'] ?>)">Delete</button>
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

    <script>
        // Fungsi konfirmasi untuk hapus
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }
    </script>
</body>

</html>