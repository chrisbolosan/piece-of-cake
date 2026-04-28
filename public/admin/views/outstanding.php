<h2>Outstanding Orders</h2>

<table border="1">
	<tr>
		<th>OrderID</th>
		<th>Customer</th>
		<th>Status</th>
		<th>Placed</th>
		<th>Actions</th>
	</tr>

	<?php while ($row = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
	<tr>
		<td><?= (int)$row['OrderID'] ?> </td>	
		<td><?= htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8') ?></td>    
		<td><?= htmlspecialchars($row['OrderStatus'], ENT_QUOTES, 'UTF-8') ?></td>    
		<td><?= htmlspecialchars($row['TimeDatePlaced'], ENT_QUOTES, 'UTF-8') ?></td>
		<td>
			<a href="?page=order_view&id=<?= (int)$row['OrderID']?>">View</a>
		</td>
	</tr>
	<?php endwhile; ?>

</table>

