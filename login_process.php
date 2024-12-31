<?php

session_start();
require_once "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    if (password_verify($password, $data['password'])) {
        $_SESSION['user_id'] = $data['id_user']; // Simpan ID pengguna ke sesi
        $_SESSION['username'] = $data['username']; // Simpan username ke sesi
        header("Location: ../WEB-PHP/view/dashboard/index.php");
    } else {
        header("Location: login.php?error=Password atau Email Salah");
    }
} else {
    header("Location: login.php?error=Password atau Email Salah");
}

$stmt->close();
$conn->close();
