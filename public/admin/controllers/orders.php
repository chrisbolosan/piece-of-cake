<?php
require_once __DIR__ . '/../../includes/config.php';

// Query prepare products
$prepare = $pdo->query("
	SELECT * O.OrderID, C.Name, O.OrderStatus, O.TimeDatePlaced, O.Notes
	FROM ORDERS O
	JOIN CUSTOMER C ON O.CustomerID = C.CustomerID 
");

$view = __DIR__ . '/../views/orders.php';

include __DIR__ . '/../views/layout.php';
