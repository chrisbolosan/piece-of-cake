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
		<!-- STATS -->
		<div class="stats-grid">
			<div class="stat-card">
				<div class="stat-info">
					<h3>Total Orders</h3>
					<div class="stat-value"><?php echo $totalOrders; ?></div>
					<div>📦</div>	
				</div>
			</div>

			<div class="stat-card">
				<div class="stat-info">
					<h3>Processing</h3>
					<div id="value" class="stat-value"><?php echo $processing; ?></div>
					<div>⏳</div>

				</div>
			</div>

			<div class="stat-card">
				<div class="stat-info">
					<h3>Completed</h3>
					<div class="stat-value"><?php echo $completed; ?></div>
					<div>✅</div>
				</div>
			</div>

			<div class="stat-card">
				<div class="stat-info">
					<h3>Pending</h3>
					<div id="value" class="stat-value"><?php echo $totalOrders - $completed - $processing; ?></div>
					<div>⏸️</div>
				</div>
			</div>
		</div>
	<!-- Charts -->
	<div class="charts-container">
		<!--buttons-->
		<div>
			<h2> Analytics & Trends</h2>
		</div>

		<!--Orders Trend Chart -->
		<div id="chart-orders">

			<h3> Orders Last 7 Days</h3>
			<canvas id="ordersChart"></canvas>
		</div>
	<div>
	</main>
<script>
const ordersByDay = <?= json_encode($ordersByDay) ?>;


</script>
</body>
</html>
