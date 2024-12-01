<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Interface</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/chat.css">   
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 chat-sidebar">
                <div class="user-item active">
                    <img src="../WEB-PHP/assets/img/download (1).png" alt="User">
                    <div>
                        <h6 class="mb-0">Refza</h6>
                        <small>Halo Guys.</small>
                    </div>
                </div>
                <div class="user-item">
                    <img src="../WEB-PHP/assets/img/download.jpeg" alt="User">
                    <div>
                        <h6 class="mb-0">Berli</h6>
                        <small>Halo Guys.</small>
                    </div>
                </div>
                <div class="user-item">
                    <img src="../WEB-PHP/assets/img/download.png" alt="User">
                    <div>
                        <h6 class="mb-0">Yustika</h6>
                        <small>kapan kapan deh.</small>
                    </div>
                </div>
            </div>

            <!-- Chat window -->
            <div class="col-9 chat-window">
                <!-- Header -->
                <div class="chat-header">
                    <!-- User info -->
                    <div class="user-info">
                        <img src="../WEB-PHP/assets/img/download.png" alt="User">
                        <h6>Yustika</h6>
                    </div>
                </div>

                <!-- Messages -->
                <div class="chat-messages">
                    <div class="message received">
                       Kamu udah ngerjain project UID belom?
                    </div>
                    <div class="message sent">
                        Duh, Aku belom yus
                    </div>
                    <div class="message received">
                        Sama sih, mau ngerjain kapan?
                    </div>
                    <div class="message sent">
                        kapan kapan deh.
                    </div>
                </div>

                <!-- Input -->
                <div class="chat-input d-flex align-items-center">
                    <input type="text" placeholder="Type your message...">
                    <button>Send</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
