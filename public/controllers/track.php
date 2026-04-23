<?php
require_once __DIR__ . '/../includes/config.php';

$order = null;
$items = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$tracking = $_POST['tracking'] ?? '';

	$prepared = $pdo->prepare("
		SELECT O.*, C.Name, D.StreetAddress, D.City, D.State, D.ZIP
		FROM ORDERS O
		JOIN CUSTOMER C ON O.CustomerID = C.CustomerID
		JOIN DESTINATION D ON O.AddressID = D.AddressID
		WHERE O.TrackingNumber =?
");
	$prepared->execute([$tracking]);

	$order = $prepared->fetch(PDO::FETCH_ASSOC);

	if ($order) {
		$items = $pdo->prepare("
			SELECT C.Flavor, C.Size, OI.Quantity
			FROM ORDER_ITEM OI
			JOIN CAKE C ON OI.CakeID = C.CakeID
			WHERE OI.OrderID = ?
		");

		$items->execute($order['Order.ID']);
	}
}

$view = __DIR__ . '/../views/track.php';
include __DIR__ . '/../views/layout.php';
