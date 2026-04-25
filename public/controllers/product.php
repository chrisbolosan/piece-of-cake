<?php
// ============================================
// SINGLE PRODUCT DETAIL PAGE CONTROLLER
// Purpose: Display storefront single product page based on ID
// Example URL: ?page=product&id=5
// ============================================

// Connect to database
require_once __DIR__ . '/../includes/config.php';

if (!isset($_GET['id'])){
	die("No product selected.");
}

// Validate GET Parameter
$ID = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM CAKE WHERE CakeID = ?");
$stmt->execute([$id]);
$cake = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$cake){
	die("Cake not found.");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$notes = htmlspecialchars($_POST['notes']);

	$_SESSION['cart'][] = [
		'id' => $cake['CakeID'],
        'flavor' => $cake['Flavor'],
        'size' => $cake['Size'],
        'price' => $cake['BasePrice'],
        'img' => $cake['Img'],
        'notes' => $notes
	];

	header("Location: index.php?page=cart");
	exit();
}

$view = __DIR__ . '/../views/product.php';
include __DIR__ . '/../views/layout.php';
?>