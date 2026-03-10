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

// Fetch all products for dropdown
$products = $conn->query("SELECT id, product_name FROM products ORDER BY product_name ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO prices (market_id, product_id, price) VALUES (?, ?, ?)");
    $stmt->bind_param("iid", $market_id, $product_id, $price);
    $stmt->execute();
    $stmt->close();

    $success = "Price added successfully for " . htmlspecialchars($market['market_name']) . "!";
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Price - <?= htmlspecialchars($market['market_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
}
.navbar-brand {
    font-weight: bold;
}
.card-add-price {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card-add-price:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
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
          <a class="nav-link active" href="add-price.php">Add Price</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view-prices.php">View Prices</a>
        </li>
      </ul>
      <span class="navbar-text text-light me-3">
        <?= htmlspecialchars($_SESSION['username']) ?> | <?= htmlspecialchars($market['market_name']) ?>
      </span>
      <a href="logout.php" class="btn btn-outline-light rounded-pill">Logout</a>
    </div>
  </div>
</nav>

<!-- Page Content -->
<div class="container my-5">
    <div class="card card-add-price shadow-sm rounded-4 p-5 mx-auto" style="max-width: 600px;">
        <h2 class="fw-bold text-success mb-4 text-center">Add New Price for <?= htmlspecialchars($market['market_name']) ?></h2>

        <?php if(isset($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold">Product</label>
                <select class="form-select p-3" name="product" required>
                    <option value="">Select Product</option>
                    <?php while($row = $products->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['product_name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Price (₦)</label>
                <input type="number" step="0.01" class="form-control p-3" name="price" placeholder="Enter price" required>
            </div>

            <button type="submit" class="btn btn-success w-100 rounded-pill p-3 mb-2">Add Price</button>
            <a class="btn btn-secondary w-100 rounded-pill p-3" href="dashboard.php">Back</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
