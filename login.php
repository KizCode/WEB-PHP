<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Task Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>


<body class="flex items-center justify-center min-h-screen bg-gray-100" style="background-image: url('file/bg/bg1.jpg'); background-size: cover; background-position: center;">
    <div class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl mx-4 p-8 bg-white rounded-lg shadow-lg">
        <!-- Container -->
        <div class="flex flex-col md:flex-row rounded-lg bg-white">
            <!-- Left Section -->
            <div class="w-full md:text-left p-8">
                <!-- Heading -->
                <div class="mb-8">
                    <h1 class="text-center text-gray-800 font-bold text-3xl md:text-4xl">
                        Hello <span class="text-blue-600">Welcome.</span>
                    </h1>
                </div>

                <!-- Form -->
                <form action="login_proces.php" method="post" class="space-y-6 text-start">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block mb-3 text-lg font-medium text-gray-900">Username</label>
                        <input name="username" type="text" id="username"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 p-4"
                            required />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block mb-3 text-lg font-medium text-gray-900">Password</label>
                        <input name="password" type="password" id="password"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 p-4"
                            placeholder="•••••••••" required />
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-gray-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-blue-700 text-lg md:text-xl focus:ring-2 focus:ring-blue-500">
                            Login
                        </button>
                    </div>

                    <!-- Link to Register -->
                    <div class="text-center">
                        <a href="register.php"
                            class="text-gray-800 hover:text-blue-600 font-bold text-lg md:text-xl">
                            Belum Punya Akun? Yuk Daftar!
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>


</html>