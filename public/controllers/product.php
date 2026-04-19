<?php
require_once __DIR__ . '/../includes/config.php';

$ID = $_GET['id'] ?? 0;

$prepared = $pdo->query("SELECT * FROM CAKE WHERE CakeID = ?");
$prepared->execute([$id]);

$cake = $stmt->fetch(PDO::FETCH_ASSOC);

$view = __DIR__ . '/../views/products.php';
include __DIR__ . '/../views/layout.php';
