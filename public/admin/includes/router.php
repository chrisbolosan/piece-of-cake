<?php

$page = $_GET['page'] ?? 'dashboard';

$page_list = [
	'dashboard'   => 'views/dashboard.php',
	'cakes'       => 'views/cakes.php',
	'cake_form'   => 'views/cake_form.php',
	'orders'      => 'views/orders.php',
	'order_view'  => 'views/order_view.php',
	'payments'    => 'views/payments.php',
	'outstanding' => 'views/outstanding.php',
	'customers'   => 'views/customers.php'
];

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (array_key_exists($page, $page_list))
{
	$view = $page_list[$page];
}
else
{
	$view = 'views/404.php';
}
