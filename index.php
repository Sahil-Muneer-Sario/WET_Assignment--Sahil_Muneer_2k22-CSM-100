<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    if (!isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] = 1;
    } else {
        $_SESSION['cart'][$item_id]++;
    }
    $msg = "Item added to cart!";
}

function getIcon($itemName) {
    $name = strtolower($itemName);
    if (strpos($name, 'cpu') !== false || strpos($name, 'processor') !== false) return '🧠';
    if (strpos($name, 'gpu') !== false || strpos($name, 'graphics') !== false) return '🎮';
    if (strpos($name, 'ram') !== false || strpos($name, 'memory') !== false) return '🧬';
    if (strpos($name, 'ssd') !== false || strpos($name, 'hard') !== false) return '💾';
    if (strpos($name, 'keyboard') !== false) return '⌨️';
    if (strpos($name, 'mouse') !== false) return '🖱️';
    if (strpos($name, 'monitor') !== false || strpos($name, 'display') !== false) return '🖥️';
    if (strpos($name, 'motherboard') !== false) return '🧩';
    if (strpos($name, 'power') !== false || strpos($name, 'psu') !== false) return '🔌';
    if (strpos($name, 'case') !== false || strpos($name, 'cabinet') !== false) return '🗃️';
    return '🛠️'; // Default icon
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Computer Hardware Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">🖥️ Hardware Hub</a>
    <div class="ms-auto">
        <a href="cart.php" class="btn btn-warning me-2">🛒 View Cart</a>
        <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>🧰 Computer Hardware Components</h3><br>
    <h3> <li>Assignment Submitted by : Sahil Muneer Sario <span style="color: red;">2K22/CSM/100</span></li></h3><br>

    <?php if (isset($msg)): ?>
        <div class="alert alert-success"><?= $msg ?></div>
    <?php endif; ?>

    <div class="row">
        <?php
        $res = $conn->query("SELECT * FROM items");
        while ($item = $res->fetch_assoc()):
        ?>
        <div class="col-md-3">
            <div class="card mb-4 shadow">
                <div class="card-body text-center">
                    <h1><?= getIcon($item['name']) ?></h1> <!-- ICON here -->
                    <h5 class="card-title"><?= $item['name'] ?></h5>
                    <p class="card-text">$<?= number_format($item['price'], 2) ?></p>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
