<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Task Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-2/4 mx-auto max-w-lg sm:px-1 bg-white rounded-lg shadow-lg">
        <div class="flex flex-col md:flex-row rounded-lg shadow-lg bg-white w-auto">
            <!-- Left Section -->
            <div class="w-full md:w-3/4 text-base md:text-lg lg:text-2xl bg-white bg-opacity-0 mx-auto rounded-r-lg px-2 py-12">
                <div class="text-center mb-2">
                    <h1 class="text-gray-800 font-bold text-base md:text-lg lg:text-2xl inline-block">Hello</h1>
                    <h1 class="text-blue-600 font-bold text-base md:text-lg lg:text-2xl inline-block">Register Now.</h1>
                </div>
                <form action="register_proces.php" method="post" class="space-y-4 m-3 text-start">
                    <!-- Full Name -->
                    <div class="flex flex-col items-start">
                        <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                        <input name="fullname" type="text" id="fullname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <!-- Email -->
                    <div class="flex flex-col items-start">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input name="email" type="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <!-- Username -->
                    <div class="flex flex-col items-start">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input name="username" type="text" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <!-- Password -->
                    <div class="flex flex-col items-start">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input name="password" type="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="•••••••••" required />
                    </div>
                    <!-- Confirm Password -->
                    <div class="flex flex-col items-start">
                        <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                        <input name="confirm_password" type="password" id="confirm_password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="•••••••••" required />
                    </div>
                    <!-- Submit Button -->
                    <div class="flex justify-start">
                        <button type="submit"
                            class="w-full bg-gray-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 text-sm md:text-lg focus:ring-2 focus:ring-blue-500">
                            Register
                        </button>
                    </div>
                    <!-- Link to Login -->
                    <div class="text-center text-gray-800 hover:text-blue-600 font-bold text-sm md:text-xl">
                        <a href="login.php">Sudah Punya Akun? Login Disini!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>