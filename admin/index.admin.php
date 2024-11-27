<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fc;
        }

        .sidebar {
            height: 100vh;
            background-color: #4e73df;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .sidebar a:hover {
            background-color: #2e59d9;
        }

        .card-header {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <? include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="col-md-full">
                <nav class="navbar navbar-light bg-white shadow mb-4">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Dashboard</span>
                        <div>
                            <a href="#" class="text-dark me-3"><i class="fas fa-bell"></i></a>
                            <a href="#" class="text-dark"><i class="fas fa-user-circle"></i> Douglas McGee</a>
                        </div>
                    </div>
                </nav>

                <div class="row">
                    <!-- Cards -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-primary text-white">Earnings (Monthly)</div>
                            <div class="card-body">$40,000</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-success text-white">Earnings (Annual)</div>
                            <div class="card-body">$215,000</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-info text-white">Tasks</div>
                            <div class="card-body">50%</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Chart Section -->
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-white">Earnings Overview</div>
                            <div class="card-body">
                                <canvas id="earningsChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header bg-white">Revenue Sources</div>
                            <div class="card-body">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Line Chart
        const earningsCtx = document.getElementById('earningsChart').getContext('2d');
        new Chart(earningsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Earnings',
                    data: [0, 10000, 20000, 15000, 30000, 40000, 30000, 50000, 40000, 60000, 70000, 80000],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    fill: true,
                }]
            },
        });

        // Pie Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social', 'Referral'],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                }]
            },
        });
    </script>
</body>

</html>