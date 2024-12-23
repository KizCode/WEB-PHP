<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style/chat.css">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 bg-white shadow-md overflow-y-auto">
            <div class="p-4 flex items-center space-x-4 border-b border-gray-200">
                <img class="w-12 h-12 rounded-full" src="../WEB-PHP/assets/img/download (1).png" alt="User">
                <div>
                    <h6 class="text-lg font-medium">Refza</h6>
                    <small class="text-gray-500">Halo Guys.</small>
                </div>
            </div>
            <div class="p-4 flex items-center space-x-4 border-b border-gray-200">
                <img class="w-12 h-12 rounded-full" src="../WEB-PHP/assets/img/download.jpeg" alt="User">
                <div>
                    <h6 class="text-lg font-medium">Berli</h6>
                    <small class="text-gray-500">Halo Guys.</small>
                </div>
            </div>
            <div class="p-4 flex items-center space-x-4 border-b border-gray-200">
                <img class="w-12 h-12 rounded-full" src="../WEB-PHP/assets/img/download.png" alt="User">
                <div>
                    <h6 class="text-lg font-medium">Yustika</h6>
                    <small class="text-gray-500">kapan kapan deh.</small>
                </div>
            </div>
        </div>

        <!-- Chat window -->
        <div class="w-3/4 flex flex-col bg-gray-50">
            <!-- Header -->
            <div class="flex items-center p-4 bg-white shadow-md">
                <img class="w-12 h-12 rounded-full" src="../WEB-PHP/assets/img/download.png" alt="User">
                <h6 class="ml-4 text-lg font-medium">Yustika</h6>
            </div>

            <!-- Messages -->
            <div class="flex-1 p-4 space-y-4 overflow-y-auto">
                <div class="flex items-start space-x-4">
                    <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Kamu udah ngerjain project UID belom?</div>
                </div>
                <div class="flex items-start justify-end space-x-4">
                    <div class="bg-blue-500 text-white px-4 py-2 rounded-lg">Duh, Aku belom yus</div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Sama sih, mau ngerjain kapan?</div>
                </div>
                <div class="flex items-start justify-end space-x-4">
                    <div class="bg-blue-500 text-white px-4 py-2 rounded-lg">kapan kapan deh.</div>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 bg-white border-t border-gray-200 flex items-center">
                <input type="text" placeholder="Type your message..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button class="ml-4 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Send</button>
            </div>
        </div>
    </div>
</body>

</html>
