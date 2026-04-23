<h3>Track Your Order</h3>

<form method="POST">
	<label>Tracking Number:</label>
	<input type="text" name="tracking" required>
	<button type="submit">Track</button>
</form>

<?php if ($order): ?>
	<p>order found</p>
<?php endif: ?>

