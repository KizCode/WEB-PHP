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
    <div class="flex flex-col md:flex-row rounded-lg shadow-lg bg-white w-2/4 ">
        <!-- Left Section -->
        <div class="w-full md:w-1/2 bg-white rounded-r-lg px-8 py-12">
            <div class="text-center mb-8">
                <h1 class="text-gray-800 font-bold text-3xl inline-block">Hello</h1>
                <h1 class="text-blue-600 font-bold text-3xl inline-block">Welcome.</h1>
            </div>
            <form action="login_proces.php" method="post"  class="space-y-6 text-start">
                <div class="flex flex-col items-start">
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input name="username" type="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div class="flex flex-col items-start">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input name="password" type="password" id="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="•••••••••" required />
                </div>
                <div class="flex justify-start">
                    <button type="submit"
                        class="w-full bg-gray-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>
                <div class="text-center text-gray-800 hover:text-blue-600 font-bold text-lg">
                    <a href="register.php">Belum Punya Akun? Yuk Daftar!</a>
                </div>
            </form>
        </div>

        <!-- Right Section -->
        <div class="hidden md:block w-3/4 rounded-r-lg" style="background-image: url('https://png.pngtree.com/thumb_back/fh260/background/20230408/pngtree-powder-smoke-colorful-background-image_2164096.jpg'); background-size: cover; background-position: center;">>
            <div class="flex items-center justify-center h-full px-16 py-12">
                <div class="text-center">
                    <h1 class="text-white font-bold text-4xl mb-4">Genius Task</h1>
                    <p class="text-white text-lg mb-6">
                        This app makes managing your tasks super easy, gets every job done on time, and boosts your
                        daily productivity.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>