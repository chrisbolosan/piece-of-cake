<h3>Track Your Order</h3>

<form method="POST">
	<label>Tracking Number:</label>
	<input type="text" name="tracking" required>
	<button type="submit">Track</button>
</form>

<?php if ($order): ?>
	<p><strong>Status:</strong><?= $order['OrderStatus'] ?></p>
	<p><strong>Tracking:</strong><?= $order['TrackingNumber'] ?></p>
	<p><strong>Placed:</strong><?= $order['TimeDatePlaced'] ?></p>
	<p><strong>Delivery:</strong><?= $order['TimeDateDelivery']?? 'TBD' ?></p>

	
<?php endif; ?>

