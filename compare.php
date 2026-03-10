<?php
include("includes/header.php");
include("includes/database.php");

// Initialize variables
$commodity = '';
$quantity = '';
$prices = [];
$best_price_market = '';

// Handle form submission
if (isset($_GET['commodity']) && !empty($_GET['commodity'])) {
    $commodity = $_GET['commodity'];
    $quantity = $_GET['quantity'] ?? '';

    // Fetch prices for the selected commodity from the three markets
    $stmt = $conn->prepare("
        SELECT m.market_name, p.price
        FROM prices p
        JOIN markets m ON p.market_id = m.id
        JOIN products pr ON p.product_id = pr.id
        WHERE pr.product_name = ?
    ");
    $stmt->bind_param("s", $commodity);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $prices[$row['market_name']] = $row['price'];
    }

    // Find the market with the lowest price
    if (!empty($prices)) {
        $best_price_market = array_search(min($prices), $prices);
    }

    $stmt->close();
}
?>

<style>
.compare-hero {
    background: linear-gradient(to right,
        rgba(25,135,84,0.7),
        rgba(25,135,84,0.5)),
        url('assets/img/compare-bg.jpg');
    background-size: cover;
    background-position: center;
    height: 40vh;
    border-radius: 16px;
}
.compare-card {
    transition: 0.3s ease-in-out;
}
.compare-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 20px rgba(0,0,0,0.15);
}
</style>

<!-- Page Header -->
<div class="container mt-4 fade-in">
    <div class="compare-hero d-flex align-items-center px-4">
        <div>
            <h1 class="text-white fw-bold">Compare Market Prices</h1>
            <p class="text-light mb-0">Select a commodity and view price differences across markets</p>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="container my-5 fade-in">
    <div class="card shadow-sm p-4 rounded-4">
        <h4 class="fw-bold mb-3 text-success">Search & Compare</h4>
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Select Commodity</label>
                    <select class="form-select p-3" name="commodity" required>
                        <option value="">Choose Item</option>
                        <?php
                        $products = $conn->query("SELECT product_name FROM products ORDER BY product_name ASC");
                        while ($prod = $products->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($prod['product_name']) ?>" <?= $prod['product_name'] === $commodity ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prod['product_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Quantity</label>
                    <select class="form-select p-3" name="quantity" required>
                        <option value="">Select Quantity</option>
                        <option value="1 Kg" <?= $quantity === '1 Kg' ? 'selected' : '' ?>>1 Kg</option>
                        <option value="5 Kg" <?= $quantity === '5 Kg' ? 'selected' : '' ?>>5 Kg</option>
                        <option value="10 Kg" <?= $quantity === '10 Kg' ? 'selected' : '' ?>>10 Kg</option>
                        <option value="50 Kg" <?= $quantity === '50 Kg' ? 'selected' : '' ?>>50 Kg</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success w-100 p-3 rounded-pill">Compare Prices</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Results Section -->
<?php if (!empty($prices)): ?>
<div class="container fade-in mb-5">
    <h3 class="fw-bold text-success mb-4">Comparison Results for <?= htmlspecialchars($commodity) ?></h3>

    <div class="row g-4">
        <?php foreach (['Sabon Gari', 'Giwa', 'Samaru'] as $market_name): ?>
            <div class="col-lg-4">
                <div class="card compare-card shadow-sm p-4 rounded-4 text-center">
                    <h4 class="fw-bold mb-2"><?= $market_name ?> Market</h4>
                    <p class="text-muted">
                        <?php
                        if ($market_name === 'Sabon Gari') echo 'Urban commercial hub';
                        elseif ($market_name === 'Giwa') echo 'Agricultural & livestock center';
                        else echo 'Student-friendly pricing';
                        ?>
                    </p>
                    <h2 class="text-success fw-bold">
                        <?= isset($prices[$market_name]) ? '₦' . number_format($prices[$market_name], 2) : 'N/A' ?>
                    </h2>
                    <a href="market-details.php?market=<?= urlencode($market_name) ?>" class="btn btn-outline-success mt-3 rounded-pill">View Market</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Best Price Badge -->
    <?php if ($best_price_market): ?>
    <div class="alert alert-success text-center mt-5 rounded-4 shadow-sm">
        <h5 class="fw-bold mb-1">Best Price Found!</h5>
        <p class="mb-0"><?= htmlspecialchars($best_price_market) ?> Market offers the lowest price for this commodity.</p>
    </div>
    <?php endif; ?>
</div>
<?php elseif ($commodity): ?>
<div class="container fade-in mb-5">
    <div class="alert alert-warning text-center rounded-4 shadow-sm">
        No price data found for <?= htmlspecialchars($commodity) ?>.
    </div>
</div>
<?php endif; ?>

<?php include("includes/footer.php"); ?>
