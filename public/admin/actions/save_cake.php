<?php
require_once '../../includes/config.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Form variables admin/views/cake_form.php
$id = $_POST['id'] ?? null;
$flavor = $_POST['flavor'];
$size = $_POST['size'];
$price = $_POST['price'];
$frosting = $_POST['frosting'];
$stock = (int)$_POST['stock'];
$img = !empty($_POST['img']) ? $_POST['img'] : 'images/soon.jpeg';

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
