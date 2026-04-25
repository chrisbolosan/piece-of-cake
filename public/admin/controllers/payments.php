<?php
require_once __DIR__ . '/../../includes/config.php';

$prepared = $pdo->query("
	SELECT P.*, O.OrderID
	FROM PAYMENT P
	JOIN ORDERS O ON P.PaymentID = O.PaymentID
");

$view = __DIR__ . '/../views/payments.php';

include __DIR__ . '/../views/layout.php';
