<h3>Track Your Order</h3>

<form method="POST">
	<label>Tracking Number:</label>
	<input type="text" name="tracking" required>
	<button type="submit">Track</button>
</form>

<?php if ($order): ?>
	<h3> Order # <?= $order['OrderID'] ?></h2>
	<p><strong>Status:</strong><?= $order['OrderStatus'] ?></p>
	<p><strong>Tracking:</strong><?= $order['TrackingNumber'] ?></p>
	<p><strong>Placed:</strong><?= $order['TimeDatePlaced'] ?></p>
	<p><strong>Delivery:</strong><?= $order['TimeDateDelivery']?? 'TBD' ?></p>


	<h4> Customer Name</h4>
	<p><?= $order['Name'] ?> </p>

	<h4> Shipping Address</h4>
	<p>
		<?= $order['StreetAddress'] ?>,
		<?= $order['City'] ?>,
		<?= $order['State'] ?>,
		<?= $order['zip'] ?>,
	</p>


<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'):?>
	<p>order not found</p>	
<?php endif; ?>

