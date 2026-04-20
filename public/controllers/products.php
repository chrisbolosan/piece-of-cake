<?php
// ============================================
// ALL PRODUCTS PAGE CONTROLLER
// Purpose: Show all products in store
//TODO: Filtering, sorting, pagination
// ============================================

// Allow query to database
require_once __DIR__ . '/../includes/config.php';

// View page to render
$view = __DIR__ . '/../views/products.php';

// Load layout wrapper
include __DIR__ . '/../views/layout.php';
