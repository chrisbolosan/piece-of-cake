<?php
require_once __DIR__ . '/../includes/config.php';

$prepared = $pdo->query("SELECT * FROM CAKE");
$view = __DIR__ . '/../views/products.php';
include __DIR__ . '/../views/layout.php';
