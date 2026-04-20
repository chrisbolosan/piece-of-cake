<?php
$id = $_GET['id'];

$order = $pdo->prepare("
	SELECT * FROM ORDERS WHERE OrderID = ?
");
$order->execute([$id]);

$items = $pdo->prepare("
	SELECT C.Flavor, C.Size, OI.Quantity, OI.UserMessage
	FROM ORDER_ITEM OI
	JOIN CAKE C ON OI.CakeID = C.CakeID
	WHERE OI.OrderID = ?
");

$items->execute([$id]);

$view = __DIR__ . '/../views/order_view.php';

include __DIR__ . '/../views/layout.php';
