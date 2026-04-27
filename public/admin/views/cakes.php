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
	<td><img src="../<?= $row['Img'] ?>" width="60"></td>
	<td></td>
	<td><?= $row['CakeID'] ?></td>
	<td><?= $row['Flavor'] ?></td>
	<td><?= $row['Size'] ?></td>
	<td>$<?= $row['BasePrice'] ?></td>
	<td><?= $row['NumInStock'] ?></td>
	<td>
		<a href="?page=cake_form&id=<?= $row['CakeID'] ?>">Edit</a>
		<a href="actions/delete_cake.php?id=<?= $row['CakeID'] ?>">Delete</a>
	</td>
</tr>
<?php endwhile; ?>
</table>

