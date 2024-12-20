<?php
session_start();
if (!isset($_SESSION['users']) == false) {
    header("Location: index.php");
    $_SESSION['prev_url'] = $_SERVER['HTTP_REFERER'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Task Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style/style.css">
    <style>
        .container {
            background-image: cover;
            zoom: 100%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class=" container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 ">
                <div class="card shadow-lg text-white" style="background-color: rgba(0, 0, 0, 0.40); border-radius: 5%;">
                    <div class=" card-body m-2">
                        <!-- Heading -->
                        <div class="text-center mb-4">
                            <?php if (isset($_GET['error'])) { ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($_GET['error']); ?>
                                </div>
                            <?php } ?>
                            <h1 class="fw-bold">Hello <span class="text-primary">Register Now.</span></h1>
                        </div>

                        <!-- Form -->
                        <form action="register_process.php" method="post">
                            <!-- Full Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <!-- Username -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Choose a username" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="•••••••••" required>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="•••••••••" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Register</button>
                            </div>

                            <!-- Link to Login -->
                            <div class="text-center mt-3">
                                <a href="login.php" class="text-decoration-none fw-bold">Sudah Punya Akun? Login Disini!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <?php include '../WEB-PHP/script.php'; ?>
</body>

</html>