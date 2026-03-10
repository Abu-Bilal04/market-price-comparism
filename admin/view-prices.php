<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

include("../includes/database.php");

// Get admin's market
$market_id = $_SESSION['market_id'];

// Fetch market name
$stmt = $conn->prepare("SELECT market_name FROM markets WHERE id=?");
$stmt->bind_param("i", $market_id);
$stmt->execute();
$market_result = $stmt->get_result();
$market = $market_result->fetch_assoc();
$stmt->close();

// Fetch prices for this market
$prices_stmt = $conn->prepare("
    SELECT p.id AS price_id, pr.product_name, p.price 
    FROM prices p 
    JOIN products pr ON p.product_id = pr.id 
    WHERE p.market_id = ? 
    ORDER BY pr.product_name ASC
");
$prices_stmt->bind_param("i", $market_id);
$prices_stmt->execute();
$prices_result = $prices_stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Prices - <?= htmlspecialchars($market['market_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
}
.table-hover tbody tr:hover {
    background-color: rgba(0, 128, 0, 0.1);
}
.card-header {
    background-color: #198754;
    color: #fff;
}
</style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="dashboard.php">Admin Panel</a>
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
          <a class="nav-link active" href="view-prices.php">View Prices</a>
        </li>
      </ul>
      <span class="navbar-text text-light me-3">
        <?= htmlspecialchars($_SESSION['username']) ?> | <?= htmlspecialchars($market['market_name']) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
    <div class="card shadow-sm rounded-4 p-4">
        <h2 class="fw-bold text-success mb-4 text-center">Prices for <?= htmlspecialchars($market['market_name']) ?></h2>

        <a href="add-price.php" class="btn btn-success mb-3 rounded-pill px-4">Add New Price</a>

        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price (₦)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($prices_result->num_rows > 0): ?>
                        <?php while($row = $prices_result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $row['price_id'] ?></td>
                                <td><?= htmlspecialchars($row['product_name']) ?></td>
                                <td><?= number_format($row['price'], 2) ?></td>
                                <td>
                                    <a href="edit-price.php?id=<?= $row['price_id'] ?>" class="btn btn-primary btn-sm rounded-pill">Edit</a>
                                    <a href="delete-price.php?id=<?= $row['price_id'] ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Are you sure you want to delete this price?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center">No prices added yet for this market.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <a href="dashboard.php" class="btn btn-secondary rounded-pill mt-3 px-4">Back to Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
