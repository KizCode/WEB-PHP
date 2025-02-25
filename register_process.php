<?php
require_once "koneksi.php";
// require_once "create_table.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ( empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Semua kolom wajib diisi!";
        header('Location: register.php');
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Password dan Konfirmasi Password tidak sesuai!";
        header('Location: register.php');
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM user WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: register.php?error=Email sudah terdaftar!");
        exit;
    }

    $insert_query = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sss", $email, $username, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header('Location: login.php');
    } else {
        $_SESSION['error'] = "Terjadi kesalahan. Silakan coba lagi.";
        header('Location: register.php');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: register.php');
    exit;
}
