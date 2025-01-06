<?php
include 'koneksi.php';

// Membuat tabel roles
$sql_roles = "CREATE TABLE IF NOT EXISTS role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);";

if (mysqli_query($conn, $sql_roles)) {
    echo "Table 'role' created successfully.<br>";
} else {
    echo "Error creating table 'role': " . mysqli_error($conn) . "<br>";
}

// Membuat tabel users
$sql_users = "CREATE TABLE IF NOT EXISTS user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 2,
    gambar VARCHAR(255) DEFAULT 'default.png',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES role(id_role) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_users)) {
    echo "Table 'user' created successfully.<br>";
} else {
    echo "Error creating table 'user': " . mysqli_error($conn) . "<br>";
}

// Membuat tabel mata_kuliah
$sql_mata_kuliah = "CREATE TABLE IF NOT EXISTS mata_kuliah (
    id_mata_kuliah INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_mata_kuliah)) {
    echo "Table 'mata_kuliah' created successfully.<br>";
} else {
    echo "Error creating table 'mata_kuliah': " . mysqli_error($conn) . "<br>";
}

// Mengubah tabel tugas untuk menambahkan foreign key mata_kuliah_id
$sql_tugas = "CREATE TABLE IF NOT EXISTS tugas (
    id_tugas INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Sedang Dikerjakan',
    reminder_time TIMESTAMP,
    user_id INT NOT NULL,
    mata_kuliah_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id_mata_kuliah) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_tugas)) {
    echo "Table 'tugas' created or modified successfully.<br>";
} else {
    echo "Error creating or modifying table 'tugas': " . mysqli_error($conn) . "<br>";
}


// Membuat tabel utas
$sql_utas = "CREATE TABLE IF NOT EXISTS utas (
    id_utas INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    gambar VARCHAR(255),
    likes INT DEFAULT 0,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_utas)) {
    echo "Table 'utas' created successfully.<br>";
} else {
    echo "Error creating table 'utas': " . mysqli_error($conn) . "<br>";
}

// Membuat tabel post
$sql_post = "CREATE TABLE IF NOT EXISTS post (
    id_post INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    likes INT DEFAULT 0,
    user_id INT NOT NULL,
    utas_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (utas_id) REFERENCES utas(id_utas) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_post)) {
    echo "Table 'post' created successfully.<br>";
} else {
    echo "Error creating table 'post': " . mysqli_error($conn) . "<br>";
}

// Membuat tabel comment
$sql_comment = "CREATE TABLE IF NOT EXISTS comment (
    id_comment INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT NOT NULL,
    likes INT DEFAULT 0,
    user_id INT NOT NULL,
    parent_id INT DEFAULT NULL,
    post_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (post_id) REFERENCES post(id_post) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES comment(id_comment) ON DELETE CASCADE ON UPDATE CASCADE
);";

if (mysqli_query($conn, $sql_comment)) {
    echo "Table 'comment' created successfully.<br>";
} else {
    echo "Error creating table 'comment': " . mysqli_error($conn) . "<br>";
}

// Memasukkan data awal ke tabel roles
$default_roles = ['admin', 'user', 'editor', 'viewer'];
foreach ($default_roles as $role) {
    $insert_role_sql = "INSERT INTO role (name) VALUES (?)";
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
$role_id_query = "SELECT id_role FROM role WHERE name = ?";
if ($stmt_role_id = mysqli_prepare($conn, $role_id_query)) {
    mysqli_stmt_bind_param($stmt_role_id, "s", $role_name);
    mysqli_stmt_execute($stmt_role_id);
    mysqli_stmt_bind_result($stmt_role_id, $role_id);
    mysqli_stmt_fetch($stmt_role_id);
    mysqli_stmt_close($stmt_role_id);
}

if (isset($role_id)) {
    $insert_user_sql = "INSERT INTO user (name, email, username, password, role_id, gambar) VALUES (?, ?, ?, ?, ?, ?)";
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
