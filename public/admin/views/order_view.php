<h2>Order Details</h2>

<?php foreach ($items as $item): ?>
    <p>
        <?= $item['Flavor'] ?> (<?= $item['Size'] ?>)
        x<?= $item['Quantity'] ?>
    </p>
    <p>Message: <?= $item['UserMessage'] ?></p>
<?php endforeach; ?>
<br>
<form method="POST" action="actions/update_order.php">
	<input type="hidden" name="order_id" value="<?= $id ?>">

	<select name="status">
		<option>Processing</option>
		<option>Completed</option>
	</select>

	<button type="submit">Update</button>
</form>
