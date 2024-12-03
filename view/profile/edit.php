<?php
session_start();

include('../../koneksi.php');

// Periksa apakah pengguna telah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Jika form disubmit, proses data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));

    // Validasi input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid.";
        exit;
    }

    // Proses upload foto jika ada
    if (!empty($_FILES['profile-picture']['name'])) {
        $target_dir = "../../assets/upload/";
        $file_name = uniqid() . "-" . basename($_FILES["profile-picture"]["name"]);
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $check = getimagesize($_FILES["profile-picture"]["tmp_name"]);
        if ($check === false) {
            echo "File yang diunggah bukan gambar.";
            exit;
        }

        if ($_FILES["profile-picture"]["size"] > 2000000) { // Maksimal 2MB
            echo "Ukuran file terlalu besar.";
            exit;
        }

        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            exit;
        }

        if (!move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
            echo "Terjadi kesalahan saat mengunggah file.";
            exit;
        }

        // Simpan nama file baru ke database
        $query_update = "UPDATE users SET name = ?, email = ?, username = ?, gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($query_update);
        $stmt->bind_param("ssssi", $name, $email, $username, $file_name, $user_id);
    } else {
        // Update tanpa mengubah foto profil
        $query_update = "UPDATE users SET name = ?, email = ?, username = ? WHERE id = ?";
        $stmt = $conn->prepare($query_update);
        $stmt->bind_param("sssi", $name, $email, $username, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profil berhasil diperbarui.";
        header("Location: ../profile/index.php");
        exit;
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Profil</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="edit.php" method="POST" enctype="multipart/form-data">
                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <!-- Foto Profil -->
                    <div class="mb-3">
                        <label for="profile-picture" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile-picture" name="profile-picture" accept="image/*">
                    </div>
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
