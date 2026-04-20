<?php
require_once '../../includes/config.php';

$id = $_POST['order_id'];
$status = $_POST['status'];

$prepared = $pdo->prepare("
	UPDATE ORDERS SET OrderStatus=? WHERE OrderID=?
");

$prepared->execute([$status, $id]);

// Redirect
header("Location: ../?page=orders");
exit;
