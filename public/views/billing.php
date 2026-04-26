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

    $stmt = $pdo->prepare("INSERT INTO ORD