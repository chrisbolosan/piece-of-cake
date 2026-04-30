<?php
require_once '../../includes/config.php';

$id = $_POST['order_id'];
$status = $_POST['status'];
$tracking = $_POST['tracking'] ?? null;
$delivery = $_POST['delivery'] ?: null;
$notes = $_POST['notes'] ?? '';

// Grab fullfillment type
$resultsFulfillment = $pdo->prepare("SELECT FulfillmentType FROM ORDERS WHERE OrderID = ?");
$resultsFulfillment->execute([$id]);
$type=$resultsFulfillment->fetchColumn();

if ($type=='Pickup') {
	$tracking = null;
}

if ($type === 'Delivery' && $status === 'Shipped' && empty($tracking)) {

	$tracking = 'TRK' . rand(10000,99999);
}

if ($status == 'Delivered' && empty($delivery)) {
	$delivery = date('Y-m-d H:i:s');
}

$prepared = $pdo->prepare("
	UPDATE ORDERS SET OrderStatus=?, TrackingNumber =?, TimeDateDelivery = ?, Notes = ? WHERE OrderID=?
");

$prepared->execute([$status, $tracking, $delivery, $notes, $id]);

$current = $pdo->prepare("SELECT OrderStatus FROM ORDERS WHERE OrderID=?");
$current->execute([$id]);
$currentStatus = $current->fetchColumn();

if($currentStatus !== 'Processing' && $status === 'Processing')
{
	die("Invalid status change");
}

// Redirect to specific order id
header("Location: ../index.php?page=order_view&id=" . $id);
exit;
