<?php
include 'koneksi.php';

// Membuat tabel roles
$sql_roles = "CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);";

if (mysqli_query($conn, $sql_roles)) {
    echo "Table 'roles' created successfully.<br>";
} else {
    echo "Error creating table 'roles': " . mysqli_error($conn) . "<br>";
}

// Membuat tabel users
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 4,
    gambar VARCHAR(255) DEFAULT 'default.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_users)) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating table 'users': " . mysqli_error($conn) . "<br>";
}

// Memasukkan data awal ke tabel roles
$default_roles = ['admin', 'user', 'editor', 'viewer'];
foreach ($default_roles as $role) {
    $insert_role_sql = "INSERT IGNORE INTO roles (name) VALUES (?)";
    if ($stmt_role = mysqli_prepare($conn, $insert_role_sql)) {
        mysqli_stmt_bind_param($stmt_role, "s", $role);
        if (mysqli_stmt_execute($stmt_role)) {
            echo "Role '$role' inserted successfully.<br>";
        } else {
            echo "Error inserting role '$role': " . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($stmt_role);
    }
}

// Memasukkan admin default ke tabel users
$password = password_hash("admin123", PASSWORD_BCRYPT);
$gambar = "default.jpg";
$role_name = "admin";

// Mengambil role_id untuk role 'admin'
$role_id_query = "SELECT id FROM roles WHERE name = ?";
if ($stmt_role_id = mysqli_prepare($conn, $role_id_query)) {
    mysqli_stmt_bind_param($stmt_role_id, "s", $role_name);
    mysqli_stmt_execute($stmt_role_id);
    mysqli_stmt_bind_result($stmt_role_id, $role_id);
    mysqli_stmt_fetch($stmt_role_id);
    mysqli_stmt_close($stmt_role_id);
}

if (isset($role_id)) {
    $insert_user_sql = "INSERT INTO users (name, email, username, password, role_id, gambar) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt_user = mysqli_prepare($conn, $insert_user_sql)) {
        $name = "Administrator";
        $email = "admin@example.com";
        $username = "admin";
        mysqli_stmt_bind_param($stmt_user, "ssssis", $name, $email, $username, $password, $role_id, $gambar);
        if (mysqli_stmt_execute($stmt_user)) {
            echo "New admin user created successfully.<br>";
        } else {
            echo "Error inserting admin user: " . mysqli_stmt_error($stmt_user) . "<br>";
        }
        mysqli_stmt_close($stmt_user);
    } else {
        echo "Error preparing admin user statement: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "Role 'admin' not found, cannot create admin user.<br>";
}

mysqli_close($conn);
?>
