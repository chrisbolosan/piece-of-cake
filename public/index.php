<?php
// ============================================
// SIMPLE ROUTER
// Purpose: This main router maps URL query string to controllers pages
// example: ?page=home -> controllers/home.php
// ============================================

ini_set('display_errors', 1);
error_reporting(E_ALL);

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

	// ========================================
	// TODO: Addd future routes here
	// - payment
	// - admin panel
	// - etc
	// ========================================	

	case 'track':
		require 'controllers/track.php';
		break;

	default:
		// Fallback route
		require 'controllers/home.php';
}
?>
