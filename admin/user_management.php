<?php
include '../koneksi.php';

session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php"); // Redirect ke login jika belum login
  exit();
}

// Ambil data user dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


// Fungsi untuk menambah user
function addUser($conn) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    // Query Insert
    $sql = "INSERT INTO users (name, email, username, password, role_id) 
            VALUES ('$name', '$email', '$username', '$password', '$role_id')";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

// Fungsi untuk menghapus user
function deleteUser($conn) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

// Fungsi untuk mendapatkan data user untuk di-edit
function getUserToEdit($conn) {
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM users WHERE id=$id");
        return $result->fetch_assoc();
    }
    return null;
}

// Fungsi untuk mengupdate data user
function updateUser($conn) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $role_id = $_POST['role_id'];
    $id = $_POST['id'];

    // Query Update
    $sql = "UPDATE users SET name='$name', email='$email', username='$username', role_id='$role_id' WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
    exit();
}

// Fungsi untuk mengambil semua users
function getAllUsers($conn) {
    return $conn->query("SELECT * FROM users ORDER BY created_at DESC");
}

// Fungsi untuk mendapatkan role berdasarkan role_id
function getRoleById($conn, $role_id) {
    $roleQuery = $conn->query("SELECT name FROM roles WHERE id = '$role_id'");
    return $roleQuery->fetch_assoc();
}

?>
