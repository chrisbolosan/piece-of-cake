<h2>Order #<?= $order['OrderID'] ?></h2>

<p><strong>Status:</strong> <?= $order['OrderStatus'] ?></p>
<p><strong>Type:</strong> <?= $order['FulfillmentType'] ?></p>
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

<form method="POST" action="actions/update_order.php" onsubmit="return validateForm()">
	<input type="hidden" name="order_id" value="<?= $id ?>">
<select name="status">

<?php if ($order['FulfillmentType'] === 'Pickup'): ?>

	<option <?= $order['OrderStatus']=='Processing'?'selected':'' ?>>Processing</option>
	<option <?= $order['OrderStatus']=='Ready for Pickup'?'selected':'' ?>>Ready for Pickup</option>
	<option <?= $order['OrderStatus']=='Delivered'?'selected':'' ?>>Delivered</option>
<?php else: ?>

	<option <?= $order['OrderStatus']=='Processing'?'selected':'' ?>>Processing</option>
	<option <?= $order['OrderStatus']=='Shipped'?'selected':'' ?>>Shipped</option>
	<option <?= $order['OrderStatus']=='Delivered'?'selected':'' ?>>Delivered</option>

<?php endif; ?>

</select>
	<br>

	<div> id="tracking-wrapper">
		<label>Tracking Number:</label>
		<input type="text" name="tracking" value="<?= htmlspecialchars($order['TrackingNumber'] ?? '') ?>">
	</div>

	<br>

	<label>Delivery Date:</label>
	<input type="datetime-local" name="delivery"
		value="<?= $order['TimeDateDelivery'] ? date('Y-m-d\TH:i', strtotime($order['TimeDateDelivery'])) : '' ?>">
	<br>
	<br>
	<label>Notes: </label>
	<textarea name="notes"><?= htmlspecialchars($order['Notes'] ?? '')?></textarea>
	<br>
	<br>
    <button type="submit">Update</button>
</form>

<script>
//javascript handle visibility
function handleTrackingShow() {
	const status = document.querySelector['[name="status"]').value;
	const type = "<?= $order['FulfillmentType'] ?>";
	const tracking = document.getElementById('tracking-wrapper');

	if (type === 'Pickup') {
		tracking.style.display = 'none';
	} else {

		if (status === 'Shipped' || status === 'Delivered') {
			tracking.style.display = 'block';
		} else {
		    tracking.style.display = 'none';
		}
	}
}

function validateForm() {
	const status = document.querySelector['[name="status"]').value;
	const type = "<?= $order['FulfillmentType'] ?>";
	const tracking = document.querySelector('[name="tracking"]').value.trim();

	if (type === 'Delivery' && status = 'Shipped' && tracking === '') {
		alert ('Tracking number required when marking order as Shipped.');
		return false;
	} 

	return true;
}

document.querySelector('[name="status"]').addEventListener('change',handleTrackingShow);
window.onload=handleTrackingShow;
</script>
