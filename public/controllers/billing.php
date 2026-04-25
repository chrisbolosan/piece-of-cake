<?php
// ============================================
// BILLING PAGE CONTROLLER
// Purpose: Display storefront billing page
// TODO: Create billing logic and query cart
// ============================================

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

require_once __DIR__ . '/../includes/config.php';
$view = __DIR__ . '/../views/billing.php';
include __DIR__ . '/../views/layout.php';
