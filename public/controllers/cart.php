<?php

// ============================================
// CART PAGE CONTROLLER
// Purpose: Display storefront fullcartpage
//TODO: Handle session based shopping car. Add, remove, update cart logic
//Documentation to understand session: https://www.php.net/manual/en/function.session-start.php
// ============================================


//cookie session
session_start();

var_dump($_POST, $_GET, $_SESSION['cart']); //Trying to see if form is submitting
exit;

$cart = $_SESSION['cart'] ?? [];


require_once __DIR__ . '/../includes/config.php';
$view = __DIR__ . '/../views/cart.php';
include __DIR__ . '/../views/layout.php';
