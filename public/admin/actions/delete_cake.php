<?php
require_once '../../includes/config.php';

$id = $_GET['id'];

$prepared = $pdo->prepare("DELETE FROM CAKE WHERE CakeID = ?");
$prepared->execute([$id]);

// Redirect after execute
header("Location: ../?page=cakes");
