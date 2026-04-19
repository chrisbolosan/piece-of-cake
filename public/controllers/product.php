<?php
// ============================================
// SINGLE PRODUCT DETAIL PAGE CONTROLLER
// Purpose: Display storefront single product page based on ID
// Example URL: ?page=product&id=5
// ============================================

// Connect to database
require_once __DIR__ . '/../includes/config.php';

// Validate GET Parameter
$ID = $_GET['id'] ?? 0;

// Fetch single product
$prepared = $pdo->prepare("SELECT * FROM CAKE WHERE CakeID = ?");
$prepared->execute([$id]);

//fetch cake data
$cake = $prepared->fetch(PDO::FETCH_ASSOC);

$view = __DIR__ . '/../views/product.php';
include __DIR__ . '/../views/layout.php';
