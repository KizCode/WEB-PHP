<?php
session_start();
include('../../koneksi.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); // Redirect ke login jika belum login
    exit();
}

// Cek jika ID tugas ada dalam request
if (isset($_POST['id'])) {
    $task_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Pastikan tugas yang ingin dihapus milik pengguna yang login
    $query = "SELECT user_id FROM tugas WHERE id_tugas = $task_id";
    $result = $conn->query($query);
    $task = $result->fetch_assoc();

    // Jika ID pengguna sesuai, hapus tugas
    if ($task && $task['user_id'] == $user_id) {
        $delete_query = "DELETE FROM tugas WHERE id_tugas = $task_id";
        if ($conn->query($delete_query)) {
            header("Location: index.php"); // Redirect setelah berhasil menghapus
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Tugas ini tidak dapat dihapus.";
    }
}
?>
