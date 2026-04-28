<h2>Orders</h2>

<table border="1">
<tr>
	<th>OrderID</th>
	<th>Customer</th>
	<th>Status</th>
	<th>Order Placed</th>
	<th>Tracking</th>
	<th>Actions</th>

</tr>

<?php while ($row = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
	<td><?= (int)$row['OrderID'] ?></td>
	<td><?= htmlspecialchars($row['Name']) ?></td>
	<td style="color: <?= $row['OrderStatus'] == 'Delivered' ? 'green' : 'orange' ?>;">
		<?= htmlspecialchars($row['OrderStatus']) ?>
	</td>
	<td><?= htmlspecialchars($row['TimeDatePlaced']) ?></td>
	<td><?= htmlspecialchars($row['TrackingNumber'] ?? '-') ?></td>
	
	<td>
		<a href="?page=order_view&id=<?= (int)$row['OrderID'] ?>">View</a>
	</td>
</tr>
<?php endwhile; ?>

</table>
