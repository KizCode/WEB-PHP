<?php
session_start();
if (!isset($_SESSION['users']) == false) {
    header("Location: index.php");
    $_SESSION['prev_url'] = $_SERVER['HTTP_REFERER'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Task Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container max-w-2xl p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <div class="mb-6 text-center">
            <?php if (isset($_GET['error'])) { ?>
                <div class="mb-4 text-red-500">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <h1 class="text-3xl font-bold">Hello <span class="text-blue-500">Register Now.</span></h1>
        </div>

        <form class="mx-5" action="register_process.php" method="post">
            <!-- Full Name -->
            <div class="mb-4">
                <label for="name" class="block mb-1 font-semibold">Full Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your full name" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block mb-1 font-semibold">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Choose a username" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="•••••••••" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="confirm_password" class="block mb-1 font-semibold">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="w-full px-4 py-2 text-gray-800 bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="•••••••••" required>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Register</button>
            </div>

            <!-- Link to Login -->
            <div class="text-center">
                <a href="login.php" class="hover:text-blue-500 font-bold">Sudah Punya Akun? Login Disini!</a>
            </div>
        </form>
    </div>
</body>

</html>
