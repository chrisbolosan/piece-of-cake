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
    // Customer Info
    $cust_name  = $_POST['cust_name'];
    $cust_email = $_POST['cust_email'];
    $cust_phone = $_POST['cust_phone'];

    // Shipping Info
    $name     = $_POST['name'];
    $address  = $_POST['address'];
    $city     = $_POST['city'];
    $state    = $_POST['state'];
    $zip      = $_POST['zip'];

    // Billing Info
    $cardname = $_POST['cardname'];
    $cardnum  = $_POST['cardnum'];
    $exp      = $_POST['exp'];
    $cvv      = $_POST['cvv'];

    // INSERT CUSTOMER
    $stmt = $pdo->prepare("
        INSERT INTO CUSTOMER (Name, Email, PhoneNum)
        VALUES (?, ?, ?)
    ");
    $stmt->execute([$cust_name, $cust_email, $cust_phone]);
    $customerID = $pdo->lastInsertId();

    // INSERT PAYMENT
    $stmt = $pdo->prepare("
        INSERT INTO PAYMENT (Method, Amount, CardholderName, CardLastFour)
        VALUES ('Card', ?, ?, ?)
    ");
    $stmt->execute([$finalTotal, $cardname, substr($cardnum, -4)]);
    $paymentID = $pdo->lastInsertId();

    // INSERT DESTINATION
    $stmt = $pdo->prepare("
        INSERT INTO DESTINATION (StreetAddress, ZIP, City, State)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$address, $zip, $city, $state]);
    $addressID = $pdo->lastInsertId();

    // INSERT ORDER
    $stmt = $pdo->prepare("
        INSERT INTO ORDERS (CustomerID, PaymentID, AddressID, Notes)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([$customerID, $paymentID, $addressID, "Order placed by ".$name]);
    $orderID = $pdo->lastInsertId();

    // INSERT ORDER ITEMS + UPDATE STOCK
    foreach ($_SESSION['cart'] as $id => $qty) {

        $stmt = $pdo->prepare("
            INSERT INTO ORDER_ITEM (OrderID, CakeID, Quantity)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$orderID, $id, $qty]);

        $stmt = $pdo->prepare("
            UPDATE CAKE
            SET NumInStock = NumInStock - ?
            WHERE CakeID = ?
        ");
        $stmt->execute([$qty, $id]);
    }

    // Clear cart
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

<div class="card" style="max-width:700px; margin:30px auto;">
<h3>Subtotal: $<?= number_format($total, 2) ?></h3>

<?php if($promoUsed): ?>
    <h3 style="color:green;">Promo Applied: -$<?= number_format($discount, 2) ?></h3>
<?php endif; ?>

<h3>Total: $<?= number_format($finalTotal, 2) ?></h3>

<form method="post">

    <h2>Customer Information</h2>
    <input type="text" name="cust_name" placeholder="Full Name" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="email" name="cust_email" placeholder="Email" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="cust_phone" placeholder="Phone Number" required style="width:95%; padding:10px; margin-bottom:10px;"><br>

    <h2>Shipping Information</h2>
    <input type="text" name="name" placeholder="Full Name" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="address" placeholder="Street Address" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="city" placeholder="City" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="state" placeholder="State" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="zip" placeholder="ZIP Code" required style="width:95%; padding:10px; margin-bottom:10px;"><br>

    <h2>Billing Information</h2>
    <input type="text" name="cardname" placeholder="Name on Card" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="cardnum" placeholder="Fake Card Number" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="exp" placeholder="Expiration Date" required style="width:95%; padding:10px; margin-bottom:10px;"><br>
    <input type="text" name="cvv" placeholder="Fake CVV" required style="width:95%; padding:10px; margin-bottom:10px;"><br>

    <h2>Promo Code</h2>
    <input type="text" name="promo" placeholder="Enter Promo Code Here" style="width:95%; padding:10px; margin-bottom:20px;"><br>

    <button type="submit" style="background:#1e2366; color:white; border:none; padding:12px 25px; font-size:18px; cursor:pointer; border-radius:6px; width:100%;">Place Order</button>
</form>
</div>

<?php else: ?>

<div class="card" style="max-width: 600px; margin:50px auto; text-align:center;">
<h1>Order Placed</h1>
<p>Your order number is <strong><?= $orderID ?></strong>.</p>
<p>Total Paid: <strong>$<?= number_format($finalTotal, 2) ?></strong></p>
<p>Status: Processing</p>
</div>

<?php endif; ?>

</body>
</html>
