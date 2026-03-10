<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
include("../includes/database.php");
include("../includes/header.php");

$id = $_GET['id'] ?? 0;

// Fetch price
$stmt = $conn->prepare("SELECT * FROM prices WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$price = $result->fetch_assoc();
$stmt->close();

if (!$price) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Price not found!</div></div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $market = $_POST['market'];
    $product = $_POST['product'];
    $newPrice = $_POST['price'];

    $stmt = $conn->prepare("UPDATE prices SET market=?, product=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $market, $product, $newPrice, $id);
    $stmt->execute();
    $stmt->close();

    $success = "Price updated successfully!";
}
?>

<div class="container mt-5">
    <h2 class="fw-bold text-success mb-4">Edit Price</h2>

    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Select Market</label>
            <select class="form-select p-3" name="market" required>
                <option value="Sabon Gari" <?= $price['market']=='Sabon Gari'?'selected':'' ?>>Sabon Gari</option>
                <option value="Giwa" <?= $price['market']=='Giwa'?'selected':'' ?>>Giwa</option>
                <option value="Samaru" <?= $price['market']=='Samaru'?'selected':'' ?>>Samaru</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control p-3" name="product" value="<?= htmlspecialchars($price['product']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (₦)</label>
            <input type="number" step="0.01" class="form-control p-3" name="price" value="<?= $price['price'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success w-100 rounded-pill p-3">Update Price</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
