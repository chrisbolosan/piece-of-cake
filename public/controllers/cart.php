<?php
//cookie session
session_start();

$cart = $_SESSION['cart'] ?? [];

require_once __DIR__ . '/../includes/config.php';
$view = __DIR__ . '/../views/cart.php';
include __DIR__ . '/../views/layout.php';
