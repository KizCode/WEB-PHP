<?php
session_start();
if (!isset($_SESSION['user']) == false) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Task Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full scale-75 md:scale-100 lg:scale-125 max-w-lg bg-gray-800 rounded-lg shadow-lg">
                <div class="p-6">
                    <!-- Heading -->
                    <div class="mb-4 text-center">
                        <h1 class="text-2xl font-bold text-white">
                            Welcome <span class="text-blue-500">Back</span>
                        </h1>
                    </div>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="mb-4 text-sm text-red-500 bg-red-100 border border-red-400 rounded-lg p-3">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php } ?>

                    <!-- Form -->
                    <form action="login_process.php" method="post" class="text-white">
                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input type="text" name="email" id="email" class="w-full px-4 py-2 mt-1 text-gray-900 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-4 relative">
                            <label for="password" class="block text-sm font-medium">Password</label>
                            <input type="password" name="password" id="password" class="w-full px-4 py-2 mt-1 text-gray-900 bg-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="•••••••••" required>
                            <button type="button" id="togglePassword" class="absolute top-9 right-3 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12m4-4a12 12 0 0 1-8-8m0 8a12 12 0 0 1 8-8m4 4a12 12 0 0 1-8 8m0-8a12 12 0 0 1 8 8" />
                                </svg>
                            </button>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-4">
                            <button type="submit" class="w-full px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">Login</button>
                        </div>

                        <!-- Link to Register -->
                        <div class="text-center mb-4">
                            <a href="resetpass.php" class="text-white text-sm hover:text-blue-500 font-bold">Lupa Password?</a>
                        </div>
                        <hr>
                        <div class="text-center mt-4">
                            <a href="register.php" class="text-white text-sm hover:text-blue-500 font-bold">Belum Punya Akun? Yuk Daftar!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            // Toggle the type attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Change the icon
            togglePassword.innerHTML =
                type === "password" ?
                `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12m4-4a12 12 0 0 1-8-8m0 8a12 12 0 0 1 8-8m4 4a12 12 0 0 1-8 8m0-8a12 12 0 0 1 8 8" />
                       </svg>` :
                `<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12m4-4a12 12 0 0 1-8-8m0 8a12 12 0 0 1 8-8m4 4a12 12 0 0 1-8 8m0-8a12 12 0 0 1 8 8" />
                       </svg>`;
        });
    </script>
</body>

</html>