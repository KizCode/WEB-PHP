<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Done</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Pastikan tema mengikuti preferensi pengguna
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-black dark:text-white">
    <header class="bg-gray-700 shadow sticky top-0">
        <nav class="container mx-auto flex items-center justify-between py-6">
            <a class="font-bold text-gray-300 text-lg" href="#">Done</a>
            <button id="menu-toggle" class="block lg:hidden">
                <span class="material-icons">menu</span>
            </button>
            <ul class="text-gray-300 hidden font-bold lg:flex space-x-6" id="menu">
                <li><a href="#features" class="hover:text-blue-500">Features</a></li>
                <li><a href="#contact" class="hover:text-blue-500">Contact</a></li>
                <li><a href="login.php" class="hover:text-blue-500">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero flex flex-col items-center justify-center h-screen text-center text-white bg-gradient-to-b from-gray-700 to-gray-200 dark:to-gray-900">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">Welcome to Our Service</h1>
        <p class="text-lg lg:text-xl max-w-2xl mb-8"></p>
        <div class="flex space-x-4">
            <a href="#features" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg">Get Started</a>
            <a href="login.php" class="btn bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-lg">Login</a>
        </div>
    </section>

    <div class="py-20 container mx-auto text-center">
        <h2 class="text-3xl font-bold mb-8">Our Teams</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <img src="https://via.placeholder.com/100" alt="Feature 1" class="mx-auto mb-4">
                <p class="font-semibold text-lg dark:text-gray-200">BERLI FERIZ ADAM</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <img src="https://via.placeholder.com/100" alt="Feature 2" class="mx-auto mb-4">
                <p class="font-semibold text-lg dark:text-gray-200">YUSTIKA DEWI AMELIA</p>
            </div>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                <img src="https://via.placeholder.com/100" alt="Feature 3" class="mx-auto mb-4">
                <p class="font-semibold text-lg dark:text-gray-200">REZFA ALHAZ</p>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
