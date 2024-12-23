<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Done</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header class="bg-white shadow sticky top-0">
        <nav class="container mx-auto flex items-center justify-between py-4">
            <a class="text-blue-500 font-bold text-lg" href="#">Done</a>
            <button id="menu-toggle" class="block lg:hidden">
                <span class="material-icons">menu</span>
            </button>
            <ul class="hidden lg:flex space-x-6" id="menu">
                <li><a href="login.php" class="text-gray-700 hover:text-blue-500">Login</a></li>
                <li><a href="#features" class="text-gray-700 hover:text-blue-500">Features</a></li>
                <li><a href="#contact" class="text-gray-700 hover:text-blue-500">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero flex flex-col items-center justify-center h-screen text-center text-white bg-gradient-to-b from-blue-400 to-cyan-400">
        <h1 class="text-4xl lg:text-5xl font-bold mb-4">Welcome to Our Service</h1>
        <p class="text-lg lg:text-xl max-w-2xl mb-8">Discover amazing features and start your journey with us today. Designed to help you succeed in your goals.</p>
        <div>
            
        </div>
        <a href="#features" class="btn bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg">Get Started</a>
        <a href="#features" class="btn bg-green-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg text-lg">Login</a>
    </section>

    <section class="py-12 bg-gray-100" id="features">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Our Teams</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Feature 1" class="mx-auto mb-4">
                    <p class="font-semibold text-lg">BERLI FERIZ ADAM</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Feature 2" class="mx-auto mb-4">
                    <p class="font-semibold text-lg">YUSTIKA DEWI AMELIA</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <img src="https://via.placeholder.com/100" alt="Feature 3" class="mx-auto mb-4">
                    <p class="font-semibold text-lg">REZFA ALHAZ</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-6" id="contact">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 My Landing Page. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("menu").classList.toggle("hidden");
        });
    </script>
</body>

</html>
