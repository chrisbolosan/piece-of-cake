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
<head>
    <meta charset="UTF-8">
    <title>Piece of Cake Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #222;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        main {
            max-width: 900px;
            margin: 40px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h1 {
            margin-top: 0;
        }
        .status {
            padding: 10px;
            border-radius: 5px;
            background: #e8f5e9;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

	<header>
		<h1>Piece of Cake Admin Panel</h1>
	</header>

	<main>
		<div class="status">
			<strong>Database Status:</strong> <?php echo htmlspecialchars($status); ?>
		</div>

			<h2>Admin Dashboard</h2>
			<div>Total Orders: <?= $totalOrders ?></div>
			<div>Processing: <?= $processing ?></div>
			<div>Completed: <?= $completed ?></div>
		</div>
	</main>

</body>
</html>
