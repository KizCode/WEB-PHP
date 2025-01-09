<?php
session_start();

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

// Query untuk mengambil data dari tabel utas
$sql = "SELECT utas.id_utas, utas.name, utas.description, utas.created_at, utas.gambar, utas.likes, user.username, utas.user_id,
               (SELECT COUNT(*) FROM post WHERE post.utas_id = utas.id_utas) AS total_replies
        FROM utas
        JOIN user ON utas.user_id = user.id_user";
$result = $conn->query($sql);

// Ambil ID utas dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_utas']) && is_numeric($_POST['id_utas'])) {
    $id_utas = (int)$_POST['id_utas'];

    if (isset($_POST['like'])) {
        $stmt = $conn->prepare("UPDATE utas SET likes = likes + 1 WHERE id_utas = ?");
        $stmt->bind_param("i", $id_utas);
        if ($stmt->execute()) {
            $_SESSION['liked_utas'][] = $id_utas;
        }
    } elseif (isset($_POST['unlike'])) {
        $stmt = $conn->prepare("UPDATE utas SET likes = likes - 1 WHERE id_utas = ?");
        $stmt->bind_param("i", $id_utas);
        if ($stmt->execute()) {
            if (($key = array_search($id_utas, $_SESSION['liked_utas'])) !== false) {
                unset($_SESSION['liked_utas'][$key]);
            }
        }
    }

    // Redirect kembali ke halaman forum
    header("Location: ./index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="mx-auto bg-[color:var(--main-color)] min-h-screen text-white flex flex-col">
    <!-- Main Content -->
    <main class="mb-auto">
        <?php include '../../utils/navbar.php'; ?>
        <div class="container mx-auto my-auto px-4 sm:px-6 lg:px-8">

            <!-- Title -->
            <h1 class="text-3xl uppercase font-bold">Forum Diskusi</h1>

            <div class="flex justify-between items-center mb-6">
                <!-- Breadcrumb -->
                <div class="text-sm text-gray-100 flex items-center space-x-2">
                    <a href="#" class="hover:text-blue-500">Diskusi</a>
                    <span>/</span>
                    <span>Beranda</span>
                </div>

                <!-- Tambah Diskusi Button -->
                <a href="create.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Tambah Diskusi
                </a>
            </div>

            <!-- Featured Question -->
            <?php while ($row = $result->fetch_assoc()) { ?>
                <section class="bg-gray-800 shadow-lg rounded-lg p-6 mb-8">
                    <div class="pb-4 pt-4">
                        <div class="flex flex-wrap sm:flex-nowrap items-start space-x-4">
                            <img src="../../assets/upload/<?= htmlspecialchars($user['gambar']) ?>" alt="User Avatar" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <a href="reply.php?id_utas=<?= htmlspecialchars($row['id_utas']) ?>" class="text-lg font-bold hover:text-blue-500 transition">
                                    <?= htmlspecialchars($row['name']) ?>
                                </a>
                                <p class="text-sm text-gray-400 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium"><?= htmlspecialchars($row['username']) ?></span> pada <?= date('d M Y', strtotime($row['created_at'])) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Show Edit Button only if the logged-in user is the creator -->
                    <?php if ($_SESSION['user_id'] == $row['user_id']) { ?>
                        <!-- Edit Button with Icon on the Right -->
                        <a href="edit.php?id_utas=<?= htmlspecialchars($row['id_utas']) ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow flex items-center space-x-2 ml-auto">
                            <span>Edit Diskusi</span>
                            <!-- Edit Icon on the Right -->
                            <i class="fas fa-edit"></i>
                        </a>
                    <?php } ?>
                </section>
            <?php } ?>

        </div>
    </main>

    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>

</html>
