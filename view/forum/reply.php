<?php
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); 
    exit();
  }

// Ambil data user dari database
include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Ambil ID utas dari URL
$id_utas = $_GET['id_utas']; // Pastikan id_utas dikirim melalui URL

// Query untuk mengambil data utas dan jumlah like
$sql_utas = "SELECT utas.*, user.username, 
            (SELECT COUNT(*) FROM post WHERE post.utas_id = utas.id_utas) AS total_replies
             FROM utas
             JOIN user ON utas.user_id = user.id_user
             WHERE utas.id_utas = $id_utas";
$result_utas = $conn->query($sql_utas);
$utas = $result_utas->fetch_assoc();
// Query untuk mengambil data post (balasan) terkait utas
$sql_post = "SELECT post.*, user.username FROM post 
             JOIN user ON post.user_id = user.id_user 
             WHERE post.utas_id = $id_utas 
             ORDER BY post.created_at ASC";
$result_post = $conn->query($sql_post);

// Periksa apakah form telah disubmit
if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];
    $utas_id = $_POST['utas_id'];
    $user_id = $_SESSION['user_id'];

    // Menyimpan balasan ke dalam tabel post
    $sql = "INSERT INTO post (utas_id, user_id, comment) VALUES ('$utas_id', '$user_id', '$comment')";
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman reply
        header("Location: reply.php?id_utas=$utas_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskusi Balasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[color:var(--main-color)] w-full text-gray-200 flex">

    <!-- Main Content -->
    <main class="flex-1 mx-auto">
        <?php include '../../utils/navbar.php'; ?>
        <div class="container mx-auto my-auto">
            <h1 class="text-3xl uppercase font-bold mb-4">Forum Diskusi</h1>

            <!-- Detail Question -->
            <section class="bg-gray-800 shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-200"><?= $utas['name'] ?></h2>
                <p class="text-sm text-gray-100 mt-1">Ditanyakan oleh <span class="text-gray-200 font-medium"><?= $utas['username'] ?></span> pada <?= date('d M Y', strtotime($utas['created_at'])) ?></p>
                <div class="mt-4">
                    <p><?= $utas['description'] ?></p>
                </div>
                <div class="mt-4 flex space-x-4 text-gray-200">
                    <div class="mt-4 flex space-x-4 text-gray-200">
                        <span class="flex items-center space-x-1">
                            <!-- Icon Like menggunakan SVG Love -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.18L12 21z"></path>
                            </svg>
                            <span><?= $utas['likes'] ?></span> <!-- Jumlah Likes -->
                        </span>
                        <span class="flex items-center space-x-1">
                            <!-- Icon Comment menggunakan SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 3H5a2 2 0 00-2 2v14l4-4h12a2 2 0 002-2V5a2 2 0 00-2-2z"></path>
                            </svg>
                            <span><?= $utas['total_replies'] ?></span> <!-- Jumlah Balasan -->
                        </span>
                    </div>
                </div>
            </section>

            <!-- Balasan Section -->
            <section>
                <h3 class="text-lg font-semibold text-gray-200 mb-4">Balasan</h3>
                <div class="space-y-4">
                    <?php while ($post = $result_post->fetch_assoc()) { ?>
                        <div class="bg-gray-800 shadow-md rounded-lg p-4">
                            <div class="flex items-start space-x-4">
                                <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="text-gray-200">
                                        <span class="font-bold"><?= $post['username'] ?></span>
                                        <span class="text-sm text-gray-200"> - <?= date('d M Y', strtotime($post['created_at'])) ?></span>
                                    </p>
                                    <p class="mt-2"><?= $post['comment'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>

            <!-- Balasan Form -->
            <form class="mt-4" method="POST">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">Balasan Anda</label>
                <textarea id="comment" name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis balasan Anda di sini..."></textarea>
                <button type="submit" name="submit" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    Kirim Balasan
                </button>
                <input type="hidden" name="utas_id" value="<?= $id_utas ?>">
            </form>
        </div>
        <?php include '../../utils/footer.php'; ?>  
    </main>

    <!-- Footer -->
</body>

</html>