<?php
session_start();
include("../includes/database.php"); // connect to database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, password, market_id FROM admin_users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();

    if ($admin && password_verify($password, $admin['password'])) {
        // Store session
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['market_id'] = $admin['market_id']; // This differentiates admins
        $_SESSION['username'] = $username;

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Zaria Market</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(to right, #198754, #20c997);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.login-card {
    max-width: 400px;
    width: 100%;
    background: #ffffff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}
.login-card h3 { color: #198754; }
</style>
</head>
<body>

<div class="login-card">
    <h3 class="fw-bold text-center mb-4">Admin Login</h3>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold">Username</label>
            <input type="text" class="form-control p-3" name="username" placeholder="Enter username" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control p-3" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-success w-100 rounded-pill p-3 mt-2">Login</button>
    </form>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
