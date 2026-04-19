<?php
require_once __DIR__ . '/../../includes/config.php';

$id=$_GET['id'] ?? null;

$cake=null;

// If product ID exists
if($id) {
	// Query by product ID
	$prepareID = $pdo->prepare("SELECT * FROM CAKE WHERE CakeID = ?");
	$prepareID->execute([$id]);
	// Fetch statement
	$cake=$prepareID->fetch()PDO::FETCH_ASSOC;
}

// Cake form page view
$view = __DIR__ . '/../views/cake_form.php';

// Include admin layout
include __DIR__ . '/../views/layout.php';
