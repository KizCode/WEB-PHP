<?php
include '../../koneksi.php';
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php"); // Redirect ke login jika belum login
    exit();
}

// Ambil data user dari database
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

// Periksa apakah ada ID user yang akan diedit
if (isset($_GET['edit'])) {
    $id_user = $_GET['edit'];
    $query = "SELECT * FROM user WHERE id_user = $id_user";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        die("User tidak ditemukan.");
    }
} else {
    die("ID user tidak ada.");
}

// Ambil data role dari database
$role_query = "SELECT * FROM role";
$role_result = mysqli_query($conn, $role_query);

// Update data user jika form disubmit
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role_id = mysqli_real_escape_string($conn, $_POST['role_id']);

    $update_query = "UPDATE user SET name = '$name', email = '$email', username = '$username', role_id = '$role_id' WHERE id_user = $id_user";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'User berhasil diperbarui.',
                icon: 'success',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = 'index.php'; // Redirect kembali ke daftar user
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat memperbarui user.',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container mx-auto mt-10 px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-xl">
                <div class="bg-gray-800 text-white text-gray-800 rounded-lg shadow-lg p-6">
                    <!-- Judul -->
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-center text-2xl font-semibold">Edit User</h5>
                        <a href="index.php" class="text-white text-lg font-bold hover:text-gray-400 transition duration-200">&times;</a>
                    </div>
                    <!-- Form -->
                    <form method="POST">
                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium mb-2">Nama:</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>"
                                class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Masukkan nama" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium mb-2">Email:</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                                class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Masukkan email" required>
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium mb-2">Username:</label>
                            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>"
                                class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Masukkan username" required>
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role_id" class="block text-sm font-medium mb-2">Role:</label>
                            <select id="role_id" name="role_id"
                                class="w-full text-black px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300 focus:outline-none" required>
                                <?php while ($role = mysqli_fetch_assoc($role_result)) { ?>
                                    <option value="<?= $role['id_role'] ?>" <?= $user['role_id'] == $role['id_role'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($role['name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" name="submit"
                            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
