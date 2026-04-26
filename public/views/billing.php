<?php
session_start();
require 'config.php';

echo __FILE__;
exit;

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
    $stmt->execute([$total, $cardname, substr($cardnum, -4)]);
    $paymentID = $pdo->lastInsertId();

    $stmt = $pdo->prepare("INSERT INTO DESTINATION (StreetAddress, ZIP, City, State) VALUES (?, ?, ?, ?)");
    $stmt->execute([$address, $zip, $city, $state]);
    $addressID = $pdo->lastInsertId();

<<<<<<< HEAD
<<<<<<< HEAD
    // Cart Reset
    $_SESSION['cart'] = [];

    $processed = true;
}

=======
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
>>>>>>> 3c129ef (accidently cut off rest of code)
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
<<<<<<< HEAD
=======
    $stmt = $pdo->prepare("INSERT INTO ORD
>>>>>>> 4a5eba9 (updated to match schema)
=======
>>>>>>> 3c129ef (accidently cut off rest of code)
