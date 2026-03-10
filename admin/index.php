<?php
session_start(); // Start the session

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); // Redirect to login page
    exit();
}

// Include header
include("../includes/header.php");
?>

<!-- Admin Dashboard Hero -->
<div class="container mt-5">
    <div class="bg-success bg-opacity-75 text-white rounded-3 p-5 d-flex align-items-center"
         style="background: url('../assets/img/admin-bg.jpg') center/cover no-repeat;">
        <div class="bg-dark bg-opacity-25 p-4 rounded w-100 text-center">
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="mb-0">Manage markets, products, and prices efficiently</p>
        </div>
    </div>
</div>

<!-- Dashboard Cards -->
<div class="container my-5">
    <div class="row g-4">

        <!-- Manage Markets -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-success">Markets</h5>
                    <p class="card-text text-muted">Add, edit, or remove markets in the system</p>
                    <a href="manage-markets.php" class="btn btn-success mt-auto rounded-pill">Manage Markets</a>
                </div>
            </div>
        </div>

        <!-- Manage Products -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-success">Products</h5>
                    <p class="card-text text-muted">Add, edit, or remove products and commodities</p>
                    <a href="manage-products.php" class="btn btn-success mt-auto rounded-pill">Manage Products</a>
                </div>
            </div>
        </div>

        <!-- Manage Prices -->
        <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-success">Market Prices</h5>
                    <p class="card-text text-muted">Update commodity prices for each market</p>
                    <a href="manage-prices.php" class="btn btn-success mt-auto rounded-pill">Manage Prices</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include("../includes/footer.php"); ?>
