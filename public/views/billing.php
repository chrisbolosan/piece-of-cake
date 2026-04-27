<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: index.php?page=cart");
    exit;
}

$total = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $stmt = $pdo->prepare("SELECT BasePrice FROM CAKE WHERE CakeID = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    $total += $row['BasePrice'] * $qty;
}

$discount = 0;
$promoUsed = false;

if(isset($_POST['promo']) && strtoupper(trim($_POST['promo'])) == "URMOM") {
    $discount = $total * 0.15;
    $promoUsed = true;
}

$finalTotal = $total - $discount;

$processed = false;
$orderID = null;

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

    $stmt = $pdo->prepare("INSERT INTO PAYMENT (Method, Amount, CardholderName, CardLastFour) VALUES ('Card', ?, ?, ?)");
    $stmt->execute([$finalTotal, $cardname, substr($cardnum, -4)]);
    $paymentID = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO DESTINATION (StreetAddress, ZIP, City, State) VALUES (?, ?, ?, ?)");
    $stmt->execute([$address, $zip, $city, $state]);
    $addressID = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO ORDERS (CustomerID, PaymentID, AddressID, Notes) VALUES (1, ?, ?, ?)");
    $stmt->execute([$paymentID, $addressID, $name]);
    $orderID = $pdo->lastInsertId();

    foreach ($_SESSION['cart'] as $id => $qty) {
    $stmt = $pdo->prepare("
        INSERT INTO ORDER_ITEM (OrderID, CakeID, Quantity)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE Quantity = Quantity + VALUES(Quantity)
    ");
    $stmt->execute([$orderID, $id, $qty]);
    }


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
<h3>Subtotal: $<?= number_format($total, 2) ?></h3>

<?php if($promoUsed): ?>
    <h3 style="color:green;">Promo Applied: -$<?= number_format($discount, 2) ?></h3>
<?php endif; ?>

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

    <h2>Promo Code</h2>
    <input type="text" name="promo" placehonder="Enter Promo Code Here"><br>

    <button type="submit">Place Order</button>
</form>

<?php else: ?>

<h1>Order Placed</h1>
<p>Your order number is <?= $orderID ?>.</p>
<p>Total Paid: $<?= number_format($finalTotal, 2) ?></p>
<p>Status: Processing</p>

<?php endif; ?>

</body>
</html>
