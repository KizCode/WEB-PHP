<?php
// Periksa apakah form telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil email dari form
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid!";
        exit;
    }

    // Tautan reset password (biasanya dengan token unik)
    $reset_token = bin2hex(random_bytes(32));
    $reset_link = "https://yourwebsite.com/reset-password.php?token=" . $reset_token;

    // Simpan token ke database (contoh implementasi)
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'your_username', 'your_password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO password_resets (email, token, created_at) VALUES (:email, :token, NOW())");
        $stmt->execute([
            ':email' => $email,
            ':token' => $reset_token,
        ]);
    } catch (PDOException $e) {
        echo "Terjadi kesalahan saat menyimpan data: " . $e->getMessage();
        exit;
    }

    // Konfigurasi email
    $subject = "Reset Password";
    $message = "
        <html>
        <head>
            <title>Reset Password</title>
        </head>
        <body>
            <p>Hai,</p>
            <p>Klik tautan berikut untuk mereset password Anda:</p>
            <p><a href='$reset_link'>$reset_link</a></p>
            <p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
        </body>
        </html>
    ";

    // Header email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@yourwebsite.com" . "\r\n";

    // Kirim email
    if (mail($email, $subject, $message, $headers)) {
        echo "Email reset password telah dikirim!";
    } else {
        echo "Gagal mengirim email.";
    }
}
?>
