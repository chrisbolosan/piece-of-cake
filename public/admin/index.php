<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = $_GET['page'] ?? dashboard;


switch($page) {
	
	case 'cakes':
		require 'controllers/cakes.php';
		break;
	
	//add edit forms
	case 'cake_form':
		require 'controllers/cake_form.php';
		break;

	case 'orders':
		require 'controllers/orders.php';
		break;

	case 'order_view':
		require 'controllers/order_view.php';
		break;

	case 'customers':
		require 'controllers/customers.php';
		break;
	
	default:
		require 'controllers/dashboard.php'; 
}
