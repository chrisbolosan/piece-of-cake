<?php
require_once __DIR__ . '/../includes/config.php';
//grab ID
$ID = $_GET['id'] ?? 0;

$prepared = $pdo->prepare("SELECT * FROM CAKE WHERE CakeID = ?");
$prepared->execute([$id]);

//fetch cake data
$cake = $prepared->fetch(PDO::FETCH_ASSOC);

$view = __DIR__ . '/../views/product.php';
include __DIR__ . '/../views/layout.php';
