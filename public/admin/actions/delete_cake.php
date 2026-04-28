<?php
require_once '../../includes/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0)
{
	//delete order association first
	$prepared1 = $pdo->prepare("DELETE FROM ORDER_ITEM WHERE CakeID = ?");
	$prepared1->execute([$id]);

	//delete product aka parent now
	$prepared2 = $pdo->prepare("DELETE FROM CAKE WHERE CakeID = ?");
	$prepared2->execute([$id]);
}

// Redirect after execute
header("Location: ../index.php?page=cakes");
exit;
