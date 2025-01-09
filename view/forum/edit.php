<?php
session_start();
include('../../koneksi.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php");
    exit();
}

include('../../koneksi.php');

// Ambil data user dari database
$user_id = (int)$_SESSION['user_id'];
$query = $conn->prepare("SELECT * FROM user WHERE id_user = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$user_id = (int)$_SESSION['user_id'];
$uts_id = $_GET['id_utas'] ?? 0;

// Query untuk mengambil data utas berdasarkan id
$query = $conn->prepare("SELECT * FROM utas WHERE id_utas = ? AND user_id = ?");
$query->bind_param("ii", $uts_id, $user_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    // Jika tidak ditemukan, redirect ke halaman utama
    header("Location: index.php");
    exit();
}

$utas = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Update data utas
    $stmt = $conn->prepare("UPDATE utas SET name = ?, description = ? WHERE id_utas = ?");
    $stmt->bind_param("ssi", $name, $description, $uts_id);
    $stmt->execute();

    // Redirect ke halaman forum setelah berhasil update
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diskusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="mx-auto bg-[color:var(--main-color)] min-h-screen text-white flex flex-col">
    <!-- Main Content -->
    <main class="mb-auto">
        <?php include '../../utils/navbar.php'; ?>
        <div class="container mx-auto my-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl uppercase font-bold">Edit Diskusi</h1>

            <form action="edit.php?id_utas=<?= htmlspecialchars($uts_id) ?>" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md mt-6">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-100">Nama Diskusi</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($utas['name']) ?>" class="mt-1 w-full text-black p-2 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-100">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 w-full text-black p-2 rounded-md" required><?= htmlspecialchars($utas['description']) ?></textarea>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                    Update Diskusi
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>
</html>
