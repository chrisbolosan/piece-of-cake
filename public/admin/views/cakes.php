<h2> Manage Cakes</h2>

<a href="?page=cake_form">+ Add Cake</a>

<table border="1">
	<tr>
		<th></th>
		<th></th>
		<th>ID</th>
		<th>Flavor</th>
		<th>Size</th>
		<th>Price</th>
		<th>Stock</th>
		<th>Actions</th>
	</tr>

<?php while ($row = $prepare->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
	<td><img src="../<?= htmlspecialchars($row['Img']) ?>" width="60" style="border-radius:4px;"></td>
	<td></td>
	<td><?= (int)$row['CakeID'] ?></td>
	<td><?= htmlspecialchars($row['Flavor']) ?></td>
	<td><?= htmlspecialchars($row['Size']) ?></td>
	<td>$<?= number_format($row['BasePrice'], 2) ?></td>
	<td><?= $row['NumInStock'] ?></td>
	<td>
		<a href="?page=cake_form&id=<?= $row['CakeID'] ?>">Edit</a>
		<a href="actions/delete_cake.php?id=<?= $row['CakeID'] ?>"
			onclick="return confirm('Are you sure you want to delete the <?= htmlspecialchars($row['Flavor']) ?> cake?');"	
			style="color:red;">
			Delete
		</a>
	</td>
</tr>
<?php endwhile; ?>
</table>

