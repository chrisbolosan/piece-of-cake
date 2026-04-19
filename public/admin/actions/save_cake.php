<?php
require_once '../../includes/config.php';

// Form variables admin/views/cake_form.php
$id = $_POST['id'] ?? null;
$flavor = $_POST['flavor'];
$size = $_POST['size'];
$price = $_POST['price'];
$frosting = $_POST['frosting'];
$stock = $_POST['stock'];

if ($id) {
	//update
	$prepared = $pdo->prepare("
	UPDATE CAKE
	SET Flavor=?, Size=?, BasePrice=?, Frosting=?, NumInStock=?
	WHERE CakeID=?	
	");
	$prepared->execute([$flavor, $size, $frosting, $stock, $id]);
} else {

	// insert			
	$prepared = $pdo->prepare("
		INSERT INTO CAKE (Flavor, Size, BasePrice, Frosting, NumInStock
	");

	$prepared->execute([$flavor, $size, $frosting, $stock]);
}

// Redirect to cakes page
header("Location: ../?page=cakes");
