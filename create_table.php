<?php
include 'koneksi.php';

// Membuat tabel user jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table user created successfully<br>";
} else {
    echo "Error creating user table: " . mysqli_error($conn) . "<br>";
}

// Menyisipkan data ke tabel user
$username = "admin";
$password = password_hash("admin123", PASSWORD_BCRYPT); // Menggunakan hashing untuk keamanan

$insert_sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $insert_sql)) {
    echo "New record created successfully<br>";
} else {
    echo "Error inserting record: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
