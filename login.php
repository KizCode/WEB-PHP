<?php
session_start();
if (!isset($_SESSION['user']) == false ) {
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style/style.css">
    <style>
        .container {
            zoom: 100%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card border-dark shadow-lg" style="background-color: rgba(0, 0, 0, 0.40); border-radius: 5%;">
                    <div class="card-body p-5">
                        <!-- Heading -->
                        <div class="mb-4 text-center">
                            <h1 class="fw-bold text-white">Welcome <span class="text-primary">Back.</span></h1>
                        </div>
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php } ?>
                        <!-- Form -->
                        <form action="login_process.php" method="post" class="text-white">
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="•••••••••" required>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                            </div>

                            <!-- Link to Register -->
                            <div class="text-center">
                                <a href="register.php" class="text-decoration-none text-white fw-bold">Belum Punya Akun? Yuk Daftar!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>