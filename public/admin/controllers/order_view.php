<?php
require_once __DIR__ . '/../../includes/config.php';
$id = $_GET['id'];

$results = $pdo->prepare("
	SELECT O.*, C.Name, C.Email, D.StreetAddress, D.City, D.State, D.ZIP
	FROM ORDERS O
	JOIN CUSTOMER C ON O.CustomerID = C.CustomerID
	JOIN DESTINATION D ON O.AddressID = D.AddressID
	WHERE O.OrderID = ?
");
$results->execute([$id]);
$order = $results->fetch(PDO::FETCH_ASSOC);

$items = $pdo->prepare("
	SELECT C.Flavor, C.Size, OI.Quantity, OI.UserMessage
	FROM ORDER_ITEM OI
	JOIN CAKE C ON OI.CakeID = C.CakeID
	WHERE OI.OrderID = ?
");

$items->execute([$id]);

$view = __DIR__ . '/../views/order_view.php';

