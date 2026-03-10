<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/database.php");

// Get admin's market
$market_id = $_SESSION['market_id'];
$admin_username = $_SESSION['username'];

// Fetch market name
$stmt = $conn->prepare("SELECT market_name FROM markets WHERE id=?");
$stmt->bind_param("i", $market_id);
$stmt->execute();
$market_result = $stmt->get_result();
$market = $market_result->fetch_assoc();
$stmt->close();

// Fetch totals for this market
// Total Products
$product_stmt = $conn->prepare("SELECT COUNT(*) as total_products FROM products");
$product_stmt->execute();
$product_count = $product_stmt->get_result()->fetch_assoc()['total_products'];
$product_stmt->close();

// Total Prices added for this market
$price_stmt = $conn->prepare("SELECT COUNT(*) as total_prices FROM prices WHERE market_id=?");
$price_stmt->bind_param("i", $market_id);
$price_stmt->execute();
$price_count = $price_stmt->get_result()->fetch_assoc()['total_prices'];
$price_stmt->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - <?= htmlspecialchars($market['market_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background-color: #f8f9fa; }
.dashboard-card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.15); }
.dashboard-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="add-price.php">Add Price</a></li>
        <li class="nav-item"><a class="nav-link" href="view-prices.php">View Prices</a></li>
      </ul>
      <span class="navbar-text text-light me-3"><?= htmlspecialchars($admin_username) ?> | <?= htmlspecialchars($market['market_name']) ?></span>
      <a href="logout.php" class="btn btn-outline-light rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<!-- Dashboard Cards -->
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-success">Admin Dashboard</h1>
        <p class="text-muted">Manage prices for <strong><?= htmlspecialchars($market['market_name']) ?></strong> market</p>
    </div>

    <div class="row g-4">

        <!-- Total Products -->
        <div class="col-md-4">
    <div class="card dashboard-card shadow-sm rounded-4 p-4 text-center">
        <h5 class="fw-bold text-success">Welcome</h5>
        <h2 class="text-success my-3">Hello, <?= htmlspecialchars($admin_username) ?>!</h2>
        <p class="text-muted">You are managing the <strong><?= htmlspecialchars($market['market_name']) ?></strong> market.</p>
        <a href="add-price.php" class="btn btn-success rounded-pill mt-2">Add a New Price</a>
    </div>
</div>


        <!-- Total Prices -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm rounded-4 p-4 text-center">
                <h5 class="fw-bold text-success">Total Prices</h5>
                <h2 class="text-success my-3"><?= $price_count ?></h2>
                <p class="text-muted">Prices added for this market</p>
                <a href="view-prices.php" class="btn btn-success rounded-pill mt-2">View Prices</a>
            </div>
        </div>

        <!-- Logout -->
        <div class="col-md-4">
            <div class="card dashboard-card shadow-sm rounded-4 p-4 text-center">
                <h5 class="fw-bold text-danger">Logout</h5>
                <p class="text-muted">End your session safely</p>
                <a href="logout.php" class="btn btn-danger rounded-pill mt-2">Logout</a>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
