<h2> Manage Cakes</h2>

<table>
	<tr>
		<th>ID</th>
		<th>Flavor</th>
		<th>Price</th>
		<th>Stock</th>
	</tr>

<?php while ($row = $prepare->fetch(PDO::FETCH_ASSOC)): ?>
	<td><?= $row['CakeID'] ?></td>
	<td><?= $row['Flavor'] ?></td>
	<td>$<?= $row['BasePrice'] ?></td>
	<td><?= $row['NumInStock'] ?></td>
<?php endwhile; ?>
</table>

