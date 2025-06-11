<?php
session_start();
include 'db.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Initialize cart from session or empty
$cart = $_SESSION['cart'] ?? [];

// Clear cart if requested
if (isset($_POST['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

// Fetch item details
$items = [];
$total = 0;
foreach ($cart as $id => $qty) {
    $res = $conn->query("SELECT * FROM items WHERE id=$id");
    if ($res && $res->num_rows > 0) {
        $item = $res->fetch_assoc();
        $item['qty'] = $qty;
        $item['subtotal'] = $item['price'] * $qty;
        $items[] = $item;
        $total += $item['subtotal'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3">
    <a class="navbar-brand" href="#">My Shop</a>
    <div class="ms-auto">
        <a href="index.php" class="btn btn-warning me-2">← Continue Shopping</a>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Your Cart</h3>

    <?php if ($items): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Total: $<?= number_format($total, 2) ?></h4>

        <a href="checkout.php" class="btn btn-success">✅ Proceed to Checkout</a>
        <form method="post" class="d-inline">
            <button name="clear" class="btn btn-danger">🗑️ Clear Cart</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info">Your cart is empty.</div>
    <?php endif; ?>
</div>
</body>
</html>
