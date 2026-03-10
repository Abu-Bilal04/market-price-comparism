<?php
// You can later add session_start() or includes here
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Price Comparison | Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar {
            background: #0d6efd;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .hero {
            height: 85vh;
            display: flex;
            align-items: center;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('assets/img/market.jpg') center/cover no-repeat;
            color: white;
        }

        .fade-in {
            animation: fadeIn 1.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .market-card {
            transition: .3s ease;
        }

        .market-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(0, 0, 0, .1);
        }

        footer {
            background: #0d6efd;
            color: #fff;
            padding: 25px 0;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">MarketCompare</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="compare.php">Compare Prices</a></li>
                    <li class="nav-item"><a class="nav-link" href="markets.php">Markets</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container text-center fade-in">
            <h1 class="display-4 fw-bold">Compare Market Prices in Zaria</h1>
            <p class="lead mt-3">Samaru • Sabon Gari • Giwa Markets</p>
            <a href="compare.php" class="btn btn-light btn-lg mt-3">Start Comparing</a>
        </div>
    </section>

    <!-- MARKET PREVIEW SECTION -->
    <section class="container my-5 fade-in">
        <h2 class="text-center fw-bold mb-4">Explore Markets</h2>
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card market-card p-3">
                    <img src="assets/img/sabongari.jpg" class="card-img-top rounded" alt="">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Sabon Gari Market</h5>
                        <p class="card-text">A major commercial hub with diverse product categories.</p>
                        <a href="market-details.php?market=sabongari" class="btn btn-primary">View Prices</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card market-card p-3">
                    <img src="assets/img/giwa.jpg" class="card-img-top rounded" alt="">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Giwa Market</h5>
                        <p class="card-text">Known for agricultural produce and livestock pricing.</p>
                        <a href="market-details.php?market=giwa" class="btn btn-primary">View Prices</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card market-card p-3">
                    <img src="assets/img/samaru.jpg" class="card-img-top rounded" alt="">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Samaru Market</h5>
                        <p class="card-text">Popular for student-friendly prices and daily essentials.</p>
                        <a href="market-details.php?market=samaru" class="btn btn-primary">View Prices</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> MarketCompare. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
