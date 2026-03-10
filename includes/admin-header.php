<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

// Get admin info
$admin_username = $_SESSION['username'];
$market_id = $_SESSION['market_id'];
include_once("database.php");

// Fetch market name
$stmt = $conn->prepare("SELECT market_name FROM markets WHERE id=?");
$stmt->bind_param("i", $market_id);
$stmt->execute();
$market_result = $stmt->get_result();
$market = $market_result->fetch_assoc();
$stmt->close();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - <?= htmlspecialchars($market['market_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
}
.navbar-brand {
    font-weight: bold;
}
.nav-link.active {
    font-weight: bold;
}
</style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="add-price.php">Add Price</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view-prices.php">View Prices</a>
        </li>
      </ul>
      <span class="navbar-text text-light me-3">
        <?= htmlspecialchars($admin_username) ?> | <?= htmlspecialchars($market['market_name']) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
