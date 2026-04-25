<h3>Track Your Order</h3>

<form method="POST">
	<label>Enter Order ID: </label>
	<input type="number" name="orderID" maxlength=8 placeholder="123" required>
	<label>Email: </label> 
	<input type="text" name="email" maxlength=30 placeholder="smith@gmail.com" required>

	<label>Tracking Number:</label>
	<input type="text" name="tracking" maxlength=8 placeholder="Enter Tracking ID" required>
	<button type="submit">Track</button>
</form>

<?php if ($order): ?>
	<h3> Order # <?= $order['OrderID'] ?></h2>
	<p><strong>Status:</strong><?= $order['OrderStatus'] ?></p>
	<p><strong>Tracking:</strong><?= $order['TrackingNumber'] ?></p>
	<p><strong>Placed:</strong><?= $order['TimeDatePlaced'] ?></p>
	<p><strong>Delivery:</strong><?= $order['TimeDateDelivery']?? 'TBD' ?></p>
	<p><strong>Order Total:</strong> $<?= $order['Amount']?></p>
	<p><strong>Total Spent:</strong> $<?= $totalSpent ?></p>

	<h4> Customer Name</h4>
	<p><?= $order['Name'] ?> </p>

	<h4> Shipping Address</h4>
	<p>
		<?= $order['StreetAddress'] ?>,
		<?= $order['City'] ?>,
		<?= $order['State'] ?>,
		<?= $order['ZIP'] ?>,
	</p>

	<h4> Customer Name</h4>
	<p><?= $order['Name'] ?> </p>

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

