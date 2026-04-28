<?php
require_once '../../includes/config.php';

$id = $_GET['id'] ? (int)$_GET['id'] : 0;

if ($id > 0)
{
	$prepared = $pdo->prepare("DELETE FROM CAKE WHERE CakeID = ?");
	$prepared->execute([$id]);
}

// Redirect after execute
header("Location: ../index.php?page=cakes");
exit;
