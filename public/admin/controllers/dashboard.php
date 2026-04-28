<?php
require_once __DIR__ . '/../../includes/config.php';

$totalOrders = $pdo->query("SELECT COUNT(*) FROM ORDERS")->fetchColumn();

$processing = $pdo->query("
	SELECT COUNT(*) FROM ORDERS WHERE OrderStatus = 'Processing'")->fetchColumn();
$completed = $pdo->query("
	SELECT COUNT(*) FROM ORDERS WHERE OrderStatus = 'Delivered'")->fetchColumn();
$shipped = $pdo->query("SELECT * FROM ORDERS WHERE OrderStatus = 'Shipped'")->fetchColumn();

// https://www.w3schools.com/sql/func_mysql_date_sub.asp
$ordersByDay = $pdo->query("
	SELECT
		DATE(TimeDatePlaced) as order_date,
		COUNT(*) as order_count,
		COALESCE(SUM(P.Amount), 0) as daily_revenue
	FROM ORDERS O
	LEFT JOIN PAYMENT P ON O.PaymentID = P.PaymentID
	WHERE TimeDatePlaced >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
	GROUP BY DATE(TimeDatePlaced)
	ORDER BY order_date ASC
")->fetchAll(PDO::FETCH_ASSOC);


$view = __DIR__ . '/../views/dashboard.php';

include __DIR__ . '/../views/layout.php';
