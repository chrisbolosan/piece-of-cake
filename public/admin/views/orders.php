<h2>Orders</h2>

<table border="1">
<tr>
	<th>OrderID</th>
	<th>Customer</th>
	<th>Status</th>
	<th>Order Placed</th>
	<th>Actions</th>

</tr>

<?php while ($row = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
	<td><?= $row['OrderID'] ?></td>
	<td><?= $row['Name'] ?></td>
	<td><?= $row['OrderStatus'] ?></td>
	<td><?= $row['TimeDatePlaced'] ?></td>
	<td>
		<a href="?page=order_view&id=<?= $row['OrderID'] ?>">View</a>
	</td>
</tr>
<?php endwhile; ?>

</table>
