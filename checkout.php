<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit;
}
$_SESSION['cart'] = []; // Clear cart on checkout
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow text-center">
        <h2>✅ Checkout Complete</h2>
        <p>Thank you for your purchase, <?= $_SESSION['user'] ?>!</p>
        <a href="index.php" class="btn btn-primary mt-3">Continue Shopping</a>
    </div>
</body>
</html>
