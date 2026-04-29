<?php
require_once __DIR__ . '/../../includes/config.php';

$prepared = $pdo->query("
	SELECT C.*, COUNT(O.OrderID) AS TotalOrders
	FROM CUSTOMER C
	LEFT JOIN ORDERS O ON C.CustomerID = O.CustomerID
	GROUP BY C.CustomerID
");
$view = __DIR__ . '/../views/customers.php';

