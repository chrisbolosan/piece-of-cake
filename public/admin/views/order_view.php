<h2>Order #<?= $order['OrderID'] ?></h2>

<p><strong>Status:</strong> <?= $order['OrderStatus'] ?></p>
<p><strong>Placed:</strong> <?= $order['TimeDatePlaced'] ?></p>
<p><strong>Delivery:</strong> <?= $order['TimeDateDelivery'] ?? 'N/A' ?></p>
<p><strong>Notes:</strong> <?= $order['Notes'] ?? 'None' ?></p>

<h3>Customer</h3>
<p><?= $order['Name'] ?> (<?= $order['Email'] ?>)</p>

<h3>Delivery Address</h3>
<p>
	<?= $order['StreetAddress'] ?>,
	<?= $order['City'] ?>, <?= $order['State'] ?> <?= $order['ZIP'] ?>
</p>

<h3>Items</h3>

<?php while ($item = $items->fetch(PDO::FETCH_ASSOC)): ?>
	<p>
		<?= $item['Flavor'] ?> (<?= $item['Size'] ?>)
		x<?= $item['Quantity'] ?>
	</p>

	<?php if ($item['UserMessage']): ?>
		<p>Message: <?= $item['UserMessage'] ?></p>
	<?php endif; ?>
<?php endwhile; ?>
<br>

<form method="POST" action="actions/update_order.php">
	<input type="hidden" name="order_id" value="<?= $id ?>">

	<select name="status">
		<option <?= $order['OrderStatus']=='Processing'?'selected':'' ?>>Processing</option>
		<option <?= $order['OrderStatus']=='Completed'?'selected':'' ?>>Completed</option>
	</select>
	<br>
<br>

	<label>Delivery Date:</label>
	<input type="datetime-local" name="delivery"
		value="<?= $order['TimeDateDelivery'] ? date('Y-m-d\TH:i', strtotime($order['TimeDateDelivery'])) : '' ?>">
	<br>
	<br>
    <button type="submit">Update</button>
</form>
