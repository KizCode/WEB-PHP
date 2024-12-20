<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hero {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            color: white;
            background: linear-gradient(to bottom, #4facfe, #00f2fe);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin: 0 0 20px;
        }

        .hero p {
            font-size: 1.25rem;
            margin: 0 0 40px;
            max-width: 600px;
        }

        .features img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <header class="bg-light shadow-sm sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light container">
            <a class="navbar-brand text-primary fw-bold" href="#">My Landing Page</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <section class="hero">
        <h1>Welcome to Our Service</h1>
        <p>Discover amazing features and start your journey with us today. Designed to help you succeed in your goals.</p>
        <a href="#features" class="btn btn-primary btn-lg">Get Started</a>
    </section>

    <section class="py-5" id="features">
        <div class="container text-center">
            <h2 class="mb-4">Our Teams</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Feature 1">
                        <div class="card-body">
                            <p class="card-text">BERLI FERIZ ADAM</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Feature 2">
                        <div class="card-body">
                            <p class="card-text">YUSTIKA DEWI AMELIA</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="https://via.placeholder.com/100" class="card-img-top mx-auto mt-3" alt="Feature 3">
                        <div class="card-body">
                            <p class="card-text">REZFA ALHAZ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4" id="contact">
        <div class="container text-center">
            <p>&copy; 2024 My Landing Page. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
