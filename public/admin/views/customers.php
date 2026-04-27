<h2> Customers </h2>

<table border="1">
<tr>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Total Orders</th>
</tr>

<?php while ($row = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
	<tr>
		<td><?= $row['Name'] ?></td>
		<td><?= $row['Email'] ?></td>
		<td><?= $row['PhoneNum'] ?></td>
		<td><?= $row['TotalOrders'] ?></td>
	</tr>
<?php endwhile; ?>

</table>

