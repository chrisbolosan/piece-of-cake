<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = $_GET['page'] ?? dashboard;


switch($page) {
	
	case 'cakes':
		require 'controllers/cakes.php';
		break;
	
	case 'dashboard':
		require 'controllers/dashboard.php';
		break;

	case 'cake_form':
		require 'controllers/cake_form.php';
		break;

	case 'customers':
		require 'controllers/customers.php';
		break;

	case 'about':
		require 'controllers/about.php';
		break;
	
	case 'orders':
		require 'controllers/orders.php';
		break;

	case 'order_view':
		require 'controllers/order_view.php';
		break;

	case 'outstanding':
		require 'controllers/outstanding.php';
		break;

	case 'payments':
		require 'controllers/payments.php';
		break;
	
	default:
		require 'controllers/404.php'; 
}
