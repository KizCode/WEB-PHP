<?php
session_start();

include('../../koneksi.php');
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Jika form disubmit, proses data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang diinputkan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $file = $_POST['file'];

    // Proses upload foto jika ada
    if ($_FILES['profile-picture']['name'] != '') {
        // Tentukan folder tempat menyimpan foto
        $target_dir = "../../assets/upload/";
        $target_file = $target_dir . basename($_FILES["profile-picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Cek apakah file adalah gambar
        if (getimagesize($_FILES["profile-picture"]["tmp_name"]) !== false) {
            // Pindahkan file ke folder upload
            if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
                echo "File " . basename($_FILES["profile-picture"]["name"]) . " telah diunggah.";
                header("location: ../profile/index.php");
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "File yang diunggah bukan gambar.";
        }
    }

    // Update data pengguna di database
    $query_update = "UPDATE users SET name = '$name', email = '$email', username = '$username' WHERE id = $user_id";
    if (mysqli_query($conn, $query_update)) {
        echo "Profil berhasil diperbarui.";
        header("location: ../profile/index.php");
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
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
                <form action="../profile/edit.php" method="POST" enctype="multipart/form-data">
                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                    </div>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Username</label>
                        <input type="tel" class="form-control" id="phone" name="username" value="<?php echo $user['username']; ?>" required>
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
