<?php
require_once __DIR__ . '/../../includes/config.php';

$prepared = $pdo->query("
	SELECT O.*, C.Name
	FROM ORDERS O
	JOIN CUSTOMER C ON O.CustomerID = C.CustomerID
	WHERE O.OrderStatus != 'Delivered'
	ORDER BY O.TimeDatePlaced ASC
");

$view = __DIR__ . '/../views/outstanding.php';
include __DIR__ . '/../views/layout.php';
