<?php
$page = $_GET['page'] ?? 'home';

switch($page) {
	case 'products':
		require 'controllers/products.php';
		break;
	
	case 'product':
		require 'controllers/product.php';
		break;
	
	case 'cart':
		require 'controllers/cart.php';
		break;

	case 'checkout':
		require 'controllers/checkout.php';
		break;

	case 'billing':
		require 'controllers/billing.php';
		break;

	default:
		require 'controllers/home.php';
}
?>
