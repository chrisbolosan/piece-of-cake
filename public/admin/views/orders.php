<h2>Orders</h2>

<table>
<tr>
	<th>OrderID</th>
	<th>Customer</th>
	<th>Status</th>
	<th>Date</th>
</tr>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
	<td><?= $row['OrderID'] ?></td>
	<td><?= $row['Name'] ?></td>
	<td><?= $row['OrderStatus'] ?></td>
	<td><?= $row['TimeDatePlaced'] ?></td>
</tr>
<?php endwhile; ?>

</table>
