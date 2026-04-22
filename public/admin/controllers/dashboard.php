<?php
require_once __DIR__ . '/../../includes/config.php';

$totalOrders = $pdo->query("SELECT COUNT(*) FROM ORDERS")->fetchColumn();

$processing = $pdo->query("
	SELECT COUNT(*) FROM ORDERS WHERE OrderStatus = 'Processing'")->fetchColumn();
$completed = $pdo->query("
	SELECT COUNT(*) FROM ORDERS WHERE OrderStatus = 'Completed'")->fetchColumn();



$view = __DIR__ . '/../views/dashboard.php';

include __DIR__ . '/../views/layout.php';
