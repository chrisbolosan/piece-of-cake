<?php
// ============================================
// BILLING PAGE CONTROLLER
// Purpose: Display storefront billing page
// TODO: Create billing logic and query cart
// ============================================

session_start();

require_once __DIR__ . '/../includes/config.php';
$view = __DIR__ . '/../views/billing.php';
include __DIR__ . '/../views/layout.php';
