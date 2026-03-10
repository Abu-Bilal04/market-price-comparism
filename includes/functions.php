<?php

// Escape HTML output
function esc($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Redirect function
function redirect($url) {
    header("Location: $url");
    exit();
}

// Fetch all markets
function getMarkets($conn) {
    $query = "SELECT * FROM markets ORDER BY market_name ASC";
    return $conn->query($query);
}

// Fetch single market by ID
function getMarket($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM markets WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Fetch products & prices for a market
function getMarketProducts($conn, $market_id) {
    $stmt = $conn->prepare("
        SELECT p.product_name, p.unit, mp.price 
        FROM market_products mp 
        JOIN products p ON mp.product_id = p.id
        WHERE mp.market_id = ?
        ORDER BY p.product_name ASC
    ");
    $stmt->bind_param("i", $market_id);
    $stmt->execute();
    return $stmt->get_result();
}
?>
