<?php
require_once '../../includes/config.php';
require_once __DIR__ . '/../../includes/errors.php';

// Form variables admin/views/cake_form.php
$id = $_POST['id'] ?? null;
$flavor = $_POST['flavor'];
$size = $_POST['size'];
$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$price = round((float)$price, 2);
$frosting = $_POST['frosting'];
$stock = (int)$_POST['stock'];
$img = !empty($_POST['img']) ? $_POST['img'] : 'images/comingsoon.png';

if ($id) {
	//update
	$prepared = $pdo->prepare("
	UPDATE CAKE
	SET Flavor=?, Size=?, BasePrice=?, Frosting=?, NumInStock=?, Img=?
	WHERE CakeID=?	
	");
	$prepared->execute([$flavor, $size, $price, $frosting, $stock, $img, $id]);
} else {

	// insert			
	$prepared = $pdo->prepare("
		INSERT INTO CAKE (Flavor, Size, BasePrice, Frosting, NumInStock, Img) 
		VALUES (?, ?, ?, ?, ?, ?)
	");

	$prepared->execute([$flavor, $size, $price, $frosting, $stock, $img]);
}

// Redirect to cakes page
header("Location: ../?page=cakes");
