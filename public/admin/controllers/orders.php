<?php
require_once __DIR__ . '/../../includes/config.php';

// Query prepare products
$prepared = $pdo->query("
	SELECT O.OrderID, C.Name, O.OrderStatus, O.TimeDatePlaced, O.TrackingNumber, O.Notes
	FROM ORDERS O
	JOIN CUSTOMER C ON O.CustomerID = C.CustomerID 
	WHERE O.OrderStatus = 'Processing'
	ORDER BY O.TimeDatePlaced ASC
");

$view = __DIR__ . '/../views/orders.php';

include __DIR__ . '/../views/layout.php';
