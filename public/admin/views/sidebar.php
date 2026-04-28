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

