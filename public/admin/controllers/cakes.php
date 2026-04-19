<?php
require_once __DIR__ . '/../../includes/config.php';

// Query prepare products
$prepare = $pdo->query("SELECT * FROM CAKE");

$view = __DIR__ . '/../views/cakes.php';
include __DIR__ . '/../views/layout.php';
