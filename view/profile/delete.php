<?php
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); // Redirect ke login jika belum login
    exit();
}

if (isset($_POST['hapus'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM users WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
