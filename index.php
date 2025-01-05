<!DOCTYPE html>
<html lang="id" class="light">

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

        function toggleTheme() {
            const html = document.documentElement;

            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
                console.log('Tema berubah ke light');
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
                console.log('Tema berubah ke dark');
            }
        }
    </script>
</head>

<body class="bg-white dark:bg-gray-900 text-black dark:text-white">
    <!-- Header -->
    <header class="bg-gray-700 shadow sticky top-0 z-50">
        <nav class="container mx-auto flex items-center justify-between py-6">
            <a class="font-bold text-gray-300 text-lg" href="#">Done</a>
            <ul class="text-gray-300 flex space-x-6 font-bold">
                <li><a href="#tentang" class="hover:text-blue-500">Tentang</a></li>
                <li><a href="#fitur" class="hover:text-blue-500">Fitur</a></li>
                <li><a href="#tim" class="hover:text-blue-500">Tim</a></li>
                <li><a href="login.php" class="hover:text-blue-500">Masuk</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero flex flex-col items-center justify-center h-screen text-center text-white bg-gradient-to-b from-gray-700 to-gray-200 dark:to-gray-900">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">Selamat Datang di Done</h1>
        <p class="text-lg lg:text-xl max-w-2xl mb-8">Sederhanakan tugas Anda dengan alat profesional kami.</p>
        <div class="flex space-x-4">
            <a href="#tentang" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg">Pelajari Lebih Lanjut</a>
            <a href="login.php" class="btn bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg text-lg">Masuk</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 container mx-auto text-center h-screen flex items-center justify-center">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-8">Tentang Kami</h2>
            <p class="text-lg max-w-3xl mx-auto mb-8">Kami menyediakan platform terbaik untuk membantu Anda mengelola tugas secara efisien dengan teknologi terkini dan desain yang ramah pengguna.</p>
            <div class="relative">
                <div class="flex overflow-x-auto snap-x snap-mandatory space-x-4 justify-center">
                    <div class="snap-center shrink-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <img src="https://via.placeholder.com/300x200" alt="Fitur 1" class="mb-4 rounded-lg">
                        <h3 class="font-semibold text-lg mb-2 dark:text-gray-200">Fitur 1</h3>
                        <p class="text-sm dark:text-gray-400">Deskripsi fitur pertama yang sangat berguna dan kuat.</p>
                    </div>
                    <div class="snap-center shrink-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <img src="https://via.placeholder.com/300x200" alt="Fitur 2" class="mb-4 rounded-lg">
                        <h3 class="font-semibold text-lg mb-2 dark:text-gray-200">Fitur 2</h3>
                        <p class="text-sm dark:text-gray-400">Deskripsi fitur kedua yang mudah digunakan dan intuitif.</p>
                    </div>
                    <div class="snap-center shrink-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <img src="https://via.placeholder.com/300x200" alt="Fitur 3" class="mb-4 rounded-lg">
                        <h3 class="font-semibold text-lg mb-2 dark:text-gray-200">Fitur 3</h3>
                        <p class="text-sm dark:text-gray-400">Deskripsi fitur ketiga yang cepat, andal, dan aman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Team Section -->
    <section id="tim" class="py-20 bg-gray-100 dark:bg-gray-800">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Tim Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Tim 1" class="mx-auto mb-4 rounded-full">
                    <p class="font-semibold text-lg dark:text-gray-200">Berli Feriz Adam</p>
                    <p class="text-sm dark:text-gray-400">Co-founder & Developer</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Tim 2" class="mx-auto mb-4 rounded-full">
                    <p class="font-semibold text-lg dark:text-gray-200">Yustika Dewi Amelia</p>
                    <p class="text-sm dark:text-gray-400">Desainer & Ahli UI</p>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Tim 3" class="mx-auto mb-4 rounded-full">
                    <p class="font-semibold text-lg dark:text-gray-200">Rezfa Alhaz</p>
                    <p class="text-sm dark:text-gray-400">Manajer Proyek</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-700 py-6 text-center text-gray-300">
        <p>&copy; 2025 Done. Hak Cipta Dilindungi.</p>
    </footer>
</body>

</html>