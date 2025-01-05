<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-100">Reset Password</h1>
        <p class="text-sm text-center text-gray-600 dark:text-gray-400 mb-6">
            Masukkan email Anda untuk menerima tautan reset password.
        </p>
        
        <!-- Form -->
        <form action="proses-reset-password.php" method="POST">
            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium mb-2 dark:text-gray-200">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
            </div>
            
            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition-all">
                Kirim Tautan Reset
            </button>
        </form>

        <!-- Link Kembali -->
        <div class="mt-6 text-center">
            <a href="login.php" class="text-blue-500 hover:underline">Kembali ke Halaman Masuk</a>
        </div>
    </div>
</body>

</html>
