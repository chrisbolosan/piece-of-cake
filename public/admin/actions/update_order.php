<?php
require_once '../../includes/config.php';

$id = $_POST['order_id'];
$status = $_POST['status'];
$tracking = $_POST['tracking'];
$delivery = $_POST['delivery'] ?: null;
$notes = $_POST['notes'];

// Grab fullfillment type
$resultsFulfillment = $pdo->prepare("SELECT Fulfillment FROM ORDERS WHERE OrderID = ?");
$resultsFulfillment->execute([$id]);
$type=$resultsFulfillment->fetchColumn();

if ($type=='Pickup') {
	$tracking == null;
}

if ($type =='Delivery' && $status === 'Shipped' && empty($tracking)) {
	die("Tracking number needed for orders that are shipped.");
}


$prepared = $pdo->prepare("
	UPDATE ORDERS SET OrderStatus=?, TrackingNumber =?, TimeDateDelivery = ?, Notes = ? WHERE OrderID=?
");

$prepared->execute([$status, $tracking, $delivery, $notes, $id]);

// Redirect to specific order id
header("Location: ../?page=order_view&id=" . $id);
exit;
