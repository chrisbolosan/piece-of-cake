<style>
.track-container {
	max-width:700px;
	margin: 40px auto;
	padding: 20px;
}

.track-card {
	background: white;
	border-radius: 10px;
	padding: 25px;
}

.track-form {
	text-align: center;
	margin-bottom: 25px;
}

.track-form button {
	padding: 10px 20px;
	cursor: pointer;
}
</style>

<div class="track-container">

	<div class="track-form">
		<h3>Track Your Order</h3>

		<form method="POST">
			<input type="number" name="orderID" maxlength=8 placeholder="Order ID" required>
			<input type="text" name="email" maxlength=30 placeholder="Email" required>
			<br><br>
			<button type="submit">Track</button>
		</form>
	</div>

		<?php if ($order): ?>

		<h3> Order # <?= $order['OrderID'] ?></h2>

		<p><strong>Status:</strong> <?= $order['OrderStatus'] ?></p>

		<?php if ($order['FulfillmentType'] === 'Pickup'): ?>
			<p><strong>Pickup Status:</strong> <?= $order['OrderStatus'] ?></p>
		<?php else: ?>

			<?php if ($order['TrackingNumber']): ?>
				<p><strong>Tracking Number:</strong> <?= $order['TrackingNumber'] ?></p>
			<?php else: ?>
				<p><em>Tracking available once your order ships.</em></p>
			<?php endif; ?>

			<h4> Shipping Address</h4>

			<p>
				<?= $order['StreetAddress'] ?>,
				<?= $order['City'] ?>,
				<?= $order['State'] ?>,
				<?= $order['ZIP'] ?>,
			</p>
		<?php endif; ?>

		<h4> Customer Name</h4>
		<p><?= $order['Name'] ?> </p>

		<p><strong>Order Total:</strong> $<?= number_format($order['Amount'], 2) ?></p>

		<p><strong>Total Spent (All Orders):</strong> $<?= number_format($totalSpent, 2) ?></p>	

		<h4> Items</h4>
		<?php while ($item = $items->fetch(PDO::FETCH_ASSOC)): ?>
			<p>
				<?= $item['Flavor'] ?>
				(<?= $item['Size'] ?>)
				 x <?= $item['Quantity'] ?>
			</p>
		<?php endwhile; ?>

	<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'):?>
		<p>order not found</p>	
	<?php endif; ?>

</div>
