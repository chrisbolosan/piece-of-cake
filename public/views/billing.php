<?php
session_start();
require_once __DIR__ . '/../includes/config.php';


// Cart validation
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

// Total Calculation
$processed = false;
$orderID = null;
$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $stmt = $pdo->prepare("SELECT BasePrice FROM CAKE WHERE CakeID = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    $total += $row['BasePrice'] * $qty;
}

// Checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $address  = $_POST['address'];
    $city     = $_POST['city'];
    $state    = $_POST['state'];
    $zip      = $_POST['zip'];
    $cardname = $_POST['cardname'];
    $cardnum  = $_POST['cardnum'];
    $exp      = $_POST['exp'];
    $cvv      = $_POST['cvv'];

    $stmt = $pdo->prepare("INSERT INTO Orders (CustomerName, Address, City, State, Zip, CardName, CardNumber, Expiration, CVV, TotalAmount, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Processing')");
    $stmt->execute([$name, $address, $city, $state, $zip, $cardname, $cardnum, $exp, $cvv, $total]);
    $orderID = $pdo->lastInsertId();

    foreach ($_SESSION['cart'] as $id => $qty) {
        $stmt = $pdo->prepare("INSERT INTO OrderItems (OrderID, ProductID, Quantity) VALUES (?, ?, ?)");
        $stmt->execute([$orderID, $id, $qty]);
    }

    // Cart Reset
    $_SESSION['cart'] = [];

    $processed = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<?php if (!$processed): ?>

<h1>Checkout</h1>
<h3>Total: $<?= number_format($total, 2) ?></h3>

<form method="post">
    <h2>Shipping Information</h2>
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="text" name="address" placeholder="Street Address" required><br>
    <input type="text" name="city" placeholder="City" required><br>
    <input type="text" name="state" placeholder="State" required><br>
    <input type="text" name="zip" placeholder="ZIP Code" required><br>

    <h2>Billing Information</h2>
    <input type="text" name="cardname" placeholder="Name on Card" required><br>
    <input type="text" name="cardnum" placeholder="Fake Card Number" required><br>
    <input type="text" name="exp" placeholder="Expiration Date" required><br>
    <input type="text" name="cvv" placeholder="Fake CVV" required><br>

    <button type="submit">Place Order</button>
</form>

<?php else: ?>

<h1>Order Placed</h1>
<p>Your order number is <?= $orderID ?>.</p>
<p>Total Paid: $<?= number_format($total, 2) ?></p>
<p>Status: Processing</p>

<?php endif; ?>

</body>
</html>
