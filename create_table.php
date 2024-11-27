<?php
include 'koneksi.php';

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role CHAR(255) NOT NULL DEFAULT 'user',
    gambar VARCHAR(255) DEFAULT 'default',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

if (mysqli_query($conn, $sql)) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table 'users': " . mysqli_error($conn) . "<br>";
}

$password = password_hash("admin123", PASSWORD_BCRYPT);

$insert_sql = "INSERT INTO users (fullname, email, username, password, role, gambar) VALUES (?, ?, ?, ?, ?, ?)";

if ($stmt = mysqli_prepare($conn, $insert_sql)) {
    $fullname = "Administrator";
    $email = "admin@example.com";
    $username = "admin";
    $role = "admin";

    mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $email, $username, $password, $role, $gambar);

    if (mysqli_stmt_execute($stmt)) {
        echo "New admin user created successfully.<br>";
    } else {
        echo "Error inserting admin user: " . mysqli_error($conn) . "<br>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn) . "<br>";
}

mysqli_close($conn);
