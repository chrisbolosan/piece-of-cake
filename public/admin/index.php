<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$page = $_GET['page'] ?? dashboard;


switch($page) {
	
	case 'cakes':
		require 'controllers/cakes.php';
		break;
	case 'orders':
		require 'controllers/orders.php';
		break;
	default:
		require 'controllers/dashboard.php'; 
}
