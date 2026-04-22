<?php
require_once __DIR__ . '/../../includes/config.php';

$status = "DB connected";

try {
	$pdo->query("SELECT 1");
} catch (PDOException $e) {
	$status = "connection failed";
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
	<main>
		<div class="status">
			<strong>Database Status:</strong> <?php echo htmlspecialchars($status); ?>
		</div>
		<div>
			<h2>Admin Dashboard</h2>
			<div>Total Orders: <?= $totalOrders ?></div>
			<div>Processing: <?= $processing ?></div>
			<div>Completed: <?= $completed ?></div>
		</div>
	</main>

</body>
</html>
