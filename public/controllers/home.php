<?php
require_once __DIR__ . '/../includes/config.php';

try {
	$prepared = $pdo->query("SELECT * FROM CAKE);
	$cakes = $prepared->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	$cakes = [];
	$error = $e->getMessage();
}

$view = __DIR__ . '/../views/home.php';
include __DIR__ . '/../views/layout.php';
