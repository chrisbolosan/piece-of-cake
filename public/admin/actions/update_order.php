<?php
require_once '../../includes/config.php';

$id = $_POST['order_id'];
$status = $_POST['status'];
$delivery = $_POST['delivery'] ?: null;
$notes = $_POST['notes'];

$prepared = $pdo->prepare("
	UPDATE ORDERS SET OrderStatus=?, TimeDateDelivery = ?, Notes = ? WHERE OrderID=?
");

$prepared->execute([$status, $delivery, $notes, $id]);

// Redirect to specific order id
header("Location: ../?page=order_view&id=" . $id);
exit;
