<?php
session_start();
include('../../koneksi.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php"); 
    exit();
  }

// Cek jika ID mata_kuliah ada dalam request
if (isset($_POST['id'])) {
    $task_id = $_POST['id'];
    $user_id = $_SESSION['user_id'];

    // Pastikan mata_kuliah yang ingin dihapus milik pengguna yang login
    $query = "SELECT user_id FROM mata_kuliah WHERE id_mata_kuliah = $task_id";
    $result = $conn->query($query);
    $task = $result->fetch_assoc();

    // Jika ID pengguna sesuai, hapus mata_kuliah
    if ($task && $task['user_id'] == $user_id) {
        $delete_query = "DELETE FROM mata_kuliah WHERE id_mata_kuliah = $task_id";
        if ($conn->query($delete_query)) {
            header("Location: ../tugas/index.php"); // Redirect setelah berhasil menghapus
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "mata_kuliah ini tidak dapat dihapus.";
    }
}
?>
?>
