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
$sql = "SELECT utas.id_utas, utas.name, utas.description, utas.created_at, utas.gambar, utas.likes, user.username,
               (SELECT COUNT(*) FROM post WHERE post.utas_id = utas.id_utas) AS total_replies
        FROM utas
        JOIN user ON utas.user_id = user.id_user";
$result = $conn->query($sql);

// Ambil ID utas dari form
if (isset($_POST['id_utas']) && is_numeric($_POST['id_utas'])) {
    $id_utas = (int) $_POST['id_utas'];

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
                    <div class="border-t border-b pb-4 pt-4">
                        <div class="flex flex-wrap sm:flex-nowrap items-start space-x-4">
                        <img src="../../assets/upload/<?= $row['gambar'] ?>" alt="User Avatar" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <a href="reply.php?id_utas=<?= $row['id_utas'] ?>" class="text-lg font-bold hover:text-blue-500 transition">
                                    <?= $row['name'] ?>
                                </a>
                                <p class="text-sm text-gray-400 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium"><?= $row['username'] ?></span> pada <?= $formatted_date = date('d M Y', strtotime($row['created_at'])); ?></p>
                                <div class="mt-2 flex space-x-6 text-gray-500">
                                    <span class="flex items-center space-x-1">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 3H5a2 2 0 00-2 2v14l4-4h12a2 2 0 002-2V5a2 2 0 00-2-2z"></path>
                                            </svg>
                                        </span>
                                        <span><?= $row['total_replies'] ?></span> <!-- Menampilkan jumlah balasan -->
                                    </span>

                                    <!-- Tombol Like -->
                                    <?php
                                    // Cek apakah user sudah memberikan like pada utas ini
                                    $is_liked = isset($_SESSION['liked_utas']) && in_array($row['id_utas'], $_SESSION['liked_utas']);
                                    ?>

                                    <?php if (!$is_liked) { ?>
                                        <form method="POST">
                                            <input type="hidden" name="id_utas" value="<?= $row['id_utas'] ?>">
                                            <button type="submit" name="like" class="flex items-center space-x-1 text-gray-400 hover:text-blue-500">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.18L12 21z"></path>
                                                    </svg>
                                                </span>
                                                <span><?= $row['likes'] ?></span>
                                            </button>
                                        </form>
                                    <?php } else { ?>
                                        <form method="POST">
                                            <input type="hidden" name="id_utas" value="<?= $row['id_utas'] ?>">
                                            <button type="submit" name="unlike" class="flex items-center space-x-1 text-red-500 hover:text-gray-400">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.18L12 21z"></path>
                                                    </svg>
                                                </span>
                                                <span><?= $row['likes'] ?></span>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../../utils/footer.php'; ?>
</body>

</html>