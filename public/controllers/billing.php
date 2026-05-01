<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

// Promo
$discount = 0;
$promoUsed = false;

if (isset($_POST['promo']) && strtoupper(trim($_POST['promo'])) === "URMOM") {
	$discount = $total * 0.15;
	$promoUsed = true;
}

$finalTotal = $total - $discount;

$processed = false;
$orderID = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$cust_name = $_POST['cust_name'];
	$cust_email = $_POST['cust_email'];
	$cust_phone = $_POST['cust_phone'];

	$name    = $_POST['name'];
	$address = $_POST['address'];
	$city    = $_POST['city'];
	$state   = $_POST['state'];
	$zip     = $_POST['zip'];

	$cardname = $_POST['cardname'];
	$cardnum  = $_POST['cardnum'];

	try {
		$pdo->beginTransaction();

		$stmt = $pdo->prepare("
			INSERT INTO PAYMENT (Method, Amount, PaymentStatus, CardholderName, CardLastFour)
			VALUES ('Card', ?, 'Completed', ?, ?)
		");

		$stmt->execute([$finalTotal, $cardname, substr($cardnum, -4)]);

		$paymentID = $pdo->lastInsertId();

		$stmt = $pdo->prepare("
			INSERT INTO CUSTOMER (Name, Email, PhoneNum)
			VALUES (?, ?, ?)
		");
		$stmt->execute([$cust_name, $cust_email, $cust_phone]);
		$customerID = $pdo->lastInsertId();

		$stmt = $pdo->prepare("
			INSERT INTO DESTINATION (StreetAddress, ZIP, City, State)
			VALUES (?, ?, ?, ?)
		");
		$stmt->execute([$address, $zip, $city, $state]);
		$addressID = $pdo->lastInsertId();

		$stmt = $pdo->prepare("
			INSERT INTO ORDERS 
			(CustomerID, PaymentID, AddressID, OrderStatus, FulfillmentType, Notes)
			VALUES (?, ?, ?, 'Processing', 'Delivery', ?)
		");
		$stmt->execute([$customerID, $paymentID, $addressID, $name]);
		$orderID = $pdo->lastInsertId();

		// ITEMS + STOCK
		foreach ($_SESSION['cart'] as $id => $qty) {

			$stmt = $pdo->prepare("
				INSERT INTO ORDER_ITEM (OrderID, CakeID, Quantity)
				VALUES (?, ?, ?)
			");
			$stmt->execute([$orderID, $id, $qty]);

			$stmt = $pdo->prepare("
				UPDATE CAKE
				SET NumInStock = NumInStock - ?
				WHERE CakeID = ? AND NumInStock >= ?
			");
			$stmt->execute([$qty, $id, $qty]);

			if ($stmt->rowCount() === 0) {
				throw new Exception("Not enough stock for CakeID $id");
			}
		}

		$pdo->commit();

		$_SESSION['cart'] = [];
		$processed = true;

	} catch (Exception $e) {
		$pdo->rollBack();
		die("Checkout failed: " . $e->getMessage());
	}
}

$view = __DIR__ . '/../views/billing.php';
include __DIR__ . '/../views/layout.php';
