<!DOCTYPE html>
<head>
	<title> </title>
	<link rel="stylesheet" href="../css/admin.css">
	<style>
	
	* {
		box-sizing: border-box;
	}

	body {
		font-family: Arial, sans-serif;
		background: #f4f6f8;
		margin: 0;
		padding: 0;
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
	/* === SIDEBAR ======= */

	.sidebar {
		width: 250px;
		background: #2c3e50;
		color: #ecf0f1;
		padding: 20px 0;
		position: fixed;
		height: 100vh;
		overflow-y: auto;
		z-index: 1000;
	}

	.sidebar-header {
		padding: 0 20px 30px;
		border-bottom: 1px solid rgba(255,255,255,0.1);
	}
	.sidebar-name {
		font-size: 20px;
		font-weight: 600;
		color: #fff;
		margin-bottom: 20px;
	}

	.user-info {
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 10px;
		background: rgba(255,255,255,0.05);
		border-radius: 8px;
	}

	.user-avatar {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		background: #3498db;
		display: flex;
		align-items: center;
		justify-content: center;
		font-weight: 600;
		font-size: 14px;
	}

	.sidebar-menu {
		list-style: none;
		padding: 20px 0;
	}

	.sidebar-menu li {
		margin: 5px 0;
	}

	.sidebar-menu a {
		display: flex;
		align-items: center;
		gap: 12px;
		padding: 12px 20px;
		color: #bdc3c7;
		text-decoration: none;
		transition: all 0.3s;
		font-size: 15px;
	}

	.sidebar-menu a:hover {
		background: rgba(231, 76, 60, 0.8);
		color: #fff;	
		
	}
	
	.sidebar-menu a.active {
		background: #e74c3c;
		color: #fff;
		border-left: 4px solid #fff;
	}
	/* === MAIN CONTAINER ======= */
	.main-content {
		padding; 100px 50px 0 0;
		margin: 0px 50px 0 300px;
		flex: 1;
		min-height: 100vh;
		display: flex;
		flex-direction: column;
	}

	.content-area {
		padding: 30px;
	}

	/* === DASHBOARD STATS CARDS  ======= */
	.stats-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
		gap: 20px;
		margin-bottom: 30px;
	}

	.stat-card {
		background: white;
		padding: 25px;
		border-radius: 10px;
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	.stat-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 4px 12px rgba(0,0,0,0.12);
	}
	</style>
</head>

<body>
	<!--SIDEBAR -->
	<aside class="sidebar">
		<div class="sidebar-header">
			<div class="sidebar-name">🎂 Piece of Cake</div>
			<div class="user-info">
				<div class="user-avatar">MM</div>
				<div>
					<div style="font-size: 12px; color: grey;">Administrator</div>
				</div>
			</div>
		</div>	
		<ul class="sidebar-menu">
			<li><a href="?page=dashboard" class="<?= ($_GET['page'] ?? 'dashboard') == 'dashboard' ? 'active' : '' ?>">🏠 Dashboard</a></li>
			<li><a href="?page=cakes" class="<?= ($_GET['page'] ?? '') == 'cakes' ? 'active' : '' ?>">🎂 Cakes</a></li>
			<li><a href="?page=orders" class="<?= ($_GET['page'] ?? '') == 'orders' ? 'active' : '' ?>">📦 Orders</a></li>
			<li><a href="?page=customers" class="<?= ($_GET['page'] ?? '') == 'customers' ? 'active' : '' ?>">👥 Customers</a></li>
			<li><a href="?page=payments" class="<?= ($_GET['page'] ?? '') == 'payments' ? 'active' : '' ?>">💳 Payments</a></li>	
			<li><a href="?page=outstanding" class="<?= ($_GET['page'] ?? '') == 'outstanding' ? 'active' : '' ?>">Outstanding</a></li>	
		</ul>
	</aside>


<div class="main-content">
	<?php include($view); ?>
</div>
</body>
</html>
