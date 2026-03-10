<?php
include("includes/header.php");
include("includes/database.php");
include("includes/functions.php");

// Fetch all markets
$markets = getMarkets($conn);
?>

<!-- Hero Section -->
<div class="container mt-5">
    <div class="bg-success bg-opacity-75 text-white rounded-3 p-5 d-flex align-items-center"
         style="background: url('assets/img/markets-bg.jpg') center/cover no-repeat;">
        <div class="bg-dark bg-opacity-25 p-4 rounded">
            <h1 class="fw-bold">Markets in Zaria</h1>
            <p class="mb-0">Explore commodity prices across Sabon Gari, Giwa, and Samaru Markets</p>
        </div>
    </div>
</div>

<!-- Markets Section -->
<div class="container my-5">
    <div class="row g-4">

        <?php if($markets && $markets->num_rows > 0): ?>
            <?php while($market = $markets->fetch_assoc()): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card shadow-sm rounded-4 h-100">
                        <img src="assets/img/<?= htmlspecialchars($market['image']) ?>" class="card-img-top rounded-top-4" alt="<?= htmlspecialchars($market['market_name']) ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-success"><?= htmlspecialchars($market['market_name']) ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($market['description']) ?></p>
                            <a href="market-details.php?id=<?= $market['id'] ?>" class="btn btn-success mt-auto rounded-pill">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center rounded-4">
                    No markets available at the moment.
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include("includes/footer.php"); ?>
