<?php include("includes/header.php"); ?>

<style>
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeIn 0.9s ease-out forwards;
}
@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.market-banner {
    background: linear-gradient(to right, rgba(0,0,0,0.4), rgba(0,0,0,0.5)),
                url('assets/img/market3.jpg');
    background-size: cover;
    background-position: center;
    height: 45vh;
    border-radius: 12px;
}
.card-shadow {
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
</style>

<!-- Page Header -->
<div class="container mt-5 fade-in">
    <div class="market-banner d-flex align-items-center px-4">
        <div>
            <h1 class="text-white fw-bold">Samaru Market</h1>
            <p class="text-light mb-0">Explore prices and products available in this market</p>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="container my-5 fade-in">
    <div class="row">

        <!-- Left: Market Info -->
        <div class="col-lg-8 mb-4">
            <div class="card rounded-4 p-4 card-shadow h-100">
                <h3 class="fw-bold">Samaru Market</h3>
                <p class="text-muted">
                    Located near Ahmadu Bello University, Samaru Market serves thousands of students
                    and residents daily. Prices here are generally moderate, especially for food and
                    daily household items.
                </p>

                <hr>

                <h5 class="fw-bold mb-3">Available Products & Prices</h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Price (₦)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Tomatoes</td><td>Basket</td><td>₦3,500</td></tr>
                            <tr><td>Rice</td><td>1 Bag (50kg)</td><td>₦57,000</td></tr>
                            <tr><td>Beans</td><td>1 Mud‍u</td><td>₦850</td></tr>
                            <tr><td>Onions</td><td>1 Bag</td><td>₦18,000</td></tr>
                            <tr><td>Garri</td><td>1 Paint</td><td>₦1,200</td></tr>
                        </tbody>
                    </table>
                </div>

                <a href="compare.php" class="btn btn-success rounded-pill mt-3">Compare Prices →</a>
            </div>
        </div>

        <!-- Right: Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card rounded-4 p-4 card-shadow sticky-top">
                <h5 class="fw-bold">Market Summary</h5>
                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Market Name:</span><strong>Samaru</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Location:</span><strong>Zaria</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Type:</span><strong>Urban/Student Market</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Avg. Price Level:</span><strong>Moderate</strong>
                    </li>
                </ul>

                <a href="markets.php" class="btn btn-outline-primary w-100 mt-4 rounded-pill">Back to Markets</a>
            </div>
        </div>

    </div>
</div>

<?php include("includes/footer.php"); ?>
