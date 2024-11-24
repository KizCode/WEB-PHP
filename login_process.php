<?php
require_once "koneksi.php";

$email = $_POST['email']; 
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
    // Verifikasi password yang di-hash
    if (password_verify($password, $data['password'])) {
        session_start();
        $_SESSION['user'] = $data['username'];
        header("Location: read_data.php");
    } else {
        header("Location: login.php?error=Password Salah");
        exit();
    }
} else {
    header("Location: login.php?error=Email Tidak Ditemukan");
    exit();
}

$stmt->close();
$conn->close();

